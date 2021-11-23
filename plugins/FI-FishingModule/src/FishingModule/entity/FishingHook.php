<?php
declare(strict_types=1);

namespace FishingModule\entity;

use FishingModule\entity\animation\FishingHookHookAnimation;
use FishingModule\event\EntityFishEvent;
use FishingModule\event\FishingHookHookEvent;
use FishingModule\item\FishingRod;
use FishingModule\Loader;
use pocketmine\block\Liquid;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Water;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\entity\projectile\Projectile;
use pocketmine\item\VanillaItems;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;
use pocketmine\utils\Random;
use pocketmine\world\particle\SplashParticle;
use pocketmine\world\particle\WaterParticle;
use pocketmine\world\World;

class FishingHook extends Projectile{

	protected $gravity = 0.1;
	protected $drag = 0.2;

	protected int $ticksCatchable = 0; //How much time player can cactch items after hook is catchable
	protected int $ticksCaughtDelay = 0; //How much time player need to wait until hook is ready to catch
	protected int $ticksCatchableDelay = 0; //How much time player need to wait from hook is ready to catch to catchable (Line of particle appeard)
	protected float $fishApproachAngle = 0;
	protected Random $random;
	//CaughtDelay (long) -> CatchableDelay (short) -> (able to catch) -> Catchable -> (unable to catch)


	public function __construct(Location $location, ?Human $shootingEntity, ?CompoundTag $nbt = null){
		$this->random = new Random(intval(microtime(true) * 1000));
		parent::__construct($location, $shootingEntity, $nbt);
	}

	public function handleHookCasting(float $x, float $y, float $z, float $f1, float $f2){
		$f = sqrt($x * $x + $y * $y + $z * $z);
		$x = $x / $f;
		$y = $y / $f;
		$z = $z / $f;
		$x = $x + $this->random->nextSignedFloat() * 0.0075 * $f2;
		$y = $y + $this->random->nextSignedFloat() * 0.0075 * $f2;
		$z = $z + $this->random->nextSignedFloat() * 0.0075 * $f2;
		$x = $x * $f1;
		$y = $y * $f1;
		$z = $z * $f1;
		$this->motion->x += $x;
		$this->motion->y += $y;
		$this->motion->z += $z;
	}

	public function getOwningEntity() : ?Human{
		if ($this->ownerId !== null){
			$player = $this->server->getWorldManager()->findEntity($this->ownerId);
			if ($player instanceof Human){
				return $player;
			}
		}
		return null;
	}

	protected function getInitialSizeInfo() : EntitySizeInfo{ return new EntitySizeInfo(0.15, 0.15); }

	public static function getNetworkTypeId() : string{ return EntityIds::FISHING_HOOK; }

	public function onUpdate(int $currentTick) : bool{
		$owner = $this->getOwningEntity();
		if ($owner === null){
			return false;
		}
		$inGround = $this->getWorld()->getBlock($this->getPosition()->asVector3())->isSolid();

		if($inGround){
			$this->motion->x *= $this->random->nextFloat() * 0.2;
			$this->motion->y *= $this->random->nextFloat() * 0.2;
			$this->motion->z *= $this->random->nextFloat() * 0.2;
		}

		if($owner->isClosed() or !$owner->isAlive() or !($owner->getInventory()->getItemInHand() instanceof FishingRod) or $owner->getPosition()->distanceSquared($this->getPosition()) > 1024){
			$this->flagForDespawn();
		}

		if((!$inGround) and $this->getWorld()->getBlock($this->getPosition()->asVector3()) instanceof Liquid){ //Check if hook is not in ground.
			$hasUpdate = true;

			$f6 = 0.92;

			if($this->onGround or $this->isCollidedHorizontally){
				$f6 = 0.5;
			}

			$d10 = 0;

			$bb = $this->getBoundingBox();

			for($j = 0; $j < 5; ++$j){
				$d1 = $bb->minY + ($bb->maxY - $bb->minY) * $j / 5;
				$d3 = $bb->minY + ($bb->maxY - $bb->minY) * ($j + 1) / 5;

				$bb2 = new AxisAlignedBB($bb->minX, $d1, $bb->minZ, $bb->maxX, $d3, $bb->maxZ);

				if($this->isLiquidInBoundingBox($this->getWorld(), $bb2, VanillaBlocks::WATER())){
					$d10 += 0.2;
				}
			}

			$d11 = $d10 * 2.0 - 1.0;
			$this->motion->y += 0.04 * $d11; //Rise up.

			if($d10 > 0.0){
				$f6 = $f6 * 0.9;
				$this->motion->y *= 0.8;
			}

			$this->motion->x *= $f6;
			$this->motion->y *= $f6;
			$this->motion->z *= $f6;

			if($this->getPosition()->isValid() and $d10 > 0){
				$this->handleFishingUpdate();
			}
		}
		if (!isset($hasUpdate)){
			$hasUpdate = parent::onUpdate($currentTick);
		}
		return $hasUpdate;
	}

	public function handleFishingUpdate(): void{
		$l = 1;
		// TODO: lightninstrike

		if($this->ticksCatchable > 0){
			--$this->ticksCatchable;

			if($this->ticksCatchable <= 0){
				$this->ticksCaughtDelay = 0;
				$this->ticksCatchableDelay = 0;
			}
		}elseif($this->ticksCatchableDelay > 0){
			$this->ticksCatchableDelay -= $l;

			if($this->ticksCatchableDelay <= 0){ // Catch
				$this->broadcastAnimation(new FishingHookHookAnimation($this));

				$this->motion->y -= 0.02;
				$this->ticksCatchable = mt_rand(10, 30);
				$ev = new FishingHookHookEvent($this->getOwningEntity(), $this);
				$ev->call();
			}else{
				$this->fishApproachAngle = $this->fishApproachAngle + $this->random->nextSignedFloat() * 4.0;
				$f7 = $this->fishApproachAngle * 0.01745;
				$f10 = sin($f7);
				$f11 = cos($f7);
				$d13 = $this->getPosition()->getX() + ($f10 * $this->ticksCatchableDelay * 0.1);
				$d15 = $this->getPosition()->getY() + 1;
				$d16 = $this->getPosition()->getZ() + ($f11 * $this->ticksCatchableDelay * 0.1);
				$block1 = $this->getWorld()->getBlock(new Vector3($d13, $d15 - 1, $d16));

				if($block1 instanceof Water){
					if($this->random->nextFloat() < 0.15){
						$this->getWorld()->addParticle(new Vector3($d13, $d15 - 0.1, $d16), new WaterParticle());
					}
					$this->getWorld()->addParticle(new Vector3($d13, $d15, $d16), new WaterParticle());
				}
			}
		}elseif($this->ticksCaughtDelay > 0){
			$this->ticksCaughtDelay -= $l;
			$f1 = 0.15;

			if($this->ticksCaughtDelay < 20){
				$f1 = ($f1 + (20 - $this->ticksCaughtDelay) * 0.05);
			}elseif($this->ticksCaughtDelay < 40){
				$f1 = ($f1 + (40 - $this->ticksCaughtDelay) * 0.02);
			}elseif($this->ticksCaughtDelay < 60){
				$f1 = ($f1 + (60 - $this->ticksCaughtDelay) * 0.01);
			}

			if($this->random->nextFloat() < $f1){
				$f9 = mt_rand(0, 360) * 0.01745;
				$f2 = mt_rand(25, 60);
				$d12 = $this->getPosition()->getX() + (sin($f9) * $f2 * 0.1);
				$d14 = floor($this->getPosition()->getY()) + 1.0;
				$d6 = $this->getPosition()->getZ() + (cos($f9) * $f2 * 0.1);
				$block = $this->getWorld()->getBlock(new Vector3($d12, $d14 - 1, $d6));

				if($block instanceof Water){
					$this->getWorld()->addParticle(new Vector3($d12, $d14, $d6), new SplashParticle());
				}
			}

			if($this->ticksCaughtDelay <= 0){
				$this->ticksCatchableDelay = mt_rand(20, 80);
				$this->fishApproachAngle = mt_rand(0, 360);
			}
		}else{
			$this->ticksCaughtDelay = mt_rand(200, 900);

			$fishing_speed = 0;
			$item = $this->getOwningEntity()?->getInventory()->getItemInHand();
			$enchant = $item->getEnchantment(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::LURE));
			if ($enchant !== null){
				$fishing_speed += $enchant->getLevel()*2;
			}
			if ($item->getNamedTag()->getTag("FishingSpeed") !== null){
				$fishing_speed += $item->getNamedTag()->getTag("FishingSpeed")->getValue();
			}
			if ($fishing_speed > 100){
				$fishing_speed = 100;
			}
			$this->ticksCaughtDelay -= (int)($this->ticksCaughtDelay*($fishing_speed/100));
		}
		if($this->ticksCatchable > 0){
			$this->motion->y -= ($this->random->nextFloat() * $this->random->nextFloat() * $this->random->nextFloat()) * 0.2;
		}
	}

	public function onRetraction() : void{
		$angler = $this->getOwningEntity();
		if ($this->isLiquidInBoundingBox($this->getWorld(), $this->getBoundingBox(), VanillaBlocks::WATER())){ //Check if a hook is in water
			if ($this->ticksCatchable > 0){
				$results = [
					VanillaItems::RAW_FISH(),
					VanillaItems::PUFFERFISH()
				];
				$xp_drop = mt_rand(0, 1);
				$ev = new EntityFishEvent($this->getOwningEntity(), $this, EntityFishEvent::STATE_CAUGHT_FISH, $xp_drop, $results);
				$ev->call();
				if (!$ev->isCancelled()){
					$this->getOwningEntity()->getPosition()->getWorld()->dropExperience($this->getOwningEntity()->getPosition(), $ev->getXpDropAmount());
					//DROP Items
					$results = $ev->getItemsResult();
					foreach($results as $result){
						$entityItem = new ItemEntity($this->getLocation(), $result);
						$d0 = $angler->getPosition()->getX() - $this->getPosition()->getX();
						$d2 = $angler->getPosition()->getY() - $this->getPosition()->getY();
						$d4 = $angler->getPosition()->getZ() - $this->getPosition()->getZ();
						$d6 = sqrt($d0 * $d0 + $d2 * $d2 + $d4 * $d4);
						$d8 = 0.1;
						$entityItem->setMotion(new Vector3($d0 * $d8, $d2 * $d8 + sqrt($d6) * 0.08, $d4 * $d8));
						$entityItem->spawnToAll();
					}
					$this->getWorld()->dropExperience($angler->getPosition()->asVector3(), $ev->getXpDropAmount());
				}
			}
		}else{
			(new EntityFishEvent($angler, $this, EntityFishEvent::STATE_CAUGHT_NOTHING))->call();
		}
		$this->flagForDespawn();
	}

	public function isLiquidInBoundingBox(World $world, AxisAlignedBB $bb, Liquid $material) : bool{
		$minX = (int) floor($bb->minX);
		$minY = (int) floor($bb->minY);
		$minZ = (int) floor($bb->minZ);
		$maxX = (int) floor($bb->maxX + 1);
		$maxY = (int) floor($bb->maxY + 1);
		$maxZ = (int) floor($bb->maxZ + 1);

		for($x = $minX; $x < $maxX; ++$x){
			for($y = $minY; $y < $maxY; ++$y){
				for($z = $minZ; $z < $maxZ; ++$z){
					$block = $world->getBlockAt($x, $y, $z);

					if($block instanceof $material){
						$j2 = $block->getMeta();
						$d0 = $y + 1;

						if($j2 < 8){
							$d0 -= $j2 / 8;
						}

						if($d0 >= $bb->minY){
							return true;
						}
					}
				}
			}
		}

		return false;
	}

	public function flagForDespawn() : void{
		$player = $this->getOwningEntity();
		if ($player instanceof Player){
			Loader::getInstance()->setFishingHook($player, null);
		}
		parent::flagForDespawn();
	}
}