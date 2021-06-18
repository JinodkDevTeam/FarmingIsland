<?php

declare(strict_types=1);

namespace FishingModule\entity;

use FishingModule\entity\animation\FishingHookHookAnimation;
use FishingModule\event\PlayerFishEvent;
use FishingModule\item\FishingRod;
use FishingModule\Loader;
use pocketmine\block\Liquid;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Water;
use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\ItemFactory;
use pocketmine\item\VanillaItems;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\RayTraceResult;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;
use pocketmine\utils\Random;
use pocketmine\world\particle\SplashParticle;
use pocketmine\world\particle\WaterParticle;
use pocketmine\world\World;

class FishingHook extends Projectile
{
	public static function getNetworkTypeId() : string {return EntityIds::FISHING_HOOK;}
	/** @var float */
	protected $gravity = 0.1;
	/** @var float */
	protected $drag = 0.05;

	protected ?Entity $caughtEntity;
	protected int $ticksCatchable = 0;
	protected int $ticksCaughtDelay = 0;
	protected int $ticksCatchableDelay = 0;
	protected float $fishApproachAngle = 0;
	protected Random $random;

	protected function getInitialSizeInfo() : EntitySizeInfo {return new EntitySizeInfo(0.15, 0.15);}

	public function attack(EntityDamageEvent $source) : void {
		if ($source instanceof EntityDamageByEntityEvent)
		{
			$source->cancel();
		}
		parent::attack($source);
	}

	public function __construct(Location $location, ?Entity $shootingEntity, ?CompoundTag $nbt = null) {
		parent::__construct($location, $shootingEntity, $nbt);
		$this->random = new Random(intval(microtime(true) * 1000));

		if ($shootingEntity instanceof Player) {
			Loader::getInstance()->setFishingHook($shootingEntity, $this);

			$this->handleHookCasting($this->motion->x, $this->motion->y, $this->motion->z, 1.5, 1.0);
		}
	}

	public function onHitEntity(Entity $entityHit, RayTraceResult $hitResult) : void {
		$entityHit->attack(new EntityDamageByEntityEvent($this, $entityHit, EntityDamageEvent::CAUSE_ENTITY_ATTACK, 0));

		$this->mountEntity($entityHit);
	}

	public function handleHookCasting(float $x, float $y, float $z, float $f1, float $f2) {
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

	public function onUpdate(int $currentTick) : bool {
		if($this->isClosed()) return false;

		$owner = $this->getOwningEntity();

		$inGround = $this->getWorld()->getBlock($this->getPosition()->asVector3());

		if($inGround) {
			$this->motion->x *= $this->random->nextFloat() * 0.2;
			$this->motion->y *= $this->random->nextFloat() * 0.2;
			$this->motion->z *= $this->random->nextFloat() * 0.2;
		}

		$hasUpdate = parent::onUpdate($currentTick);

		if($owner instanceof Player){
			if($owner->isClosed() or !$owner->isAlive() or !($owner->getInventory()->getItemInHand() instanceof FishingRod) or $owner->getPosition()->distanceSquared($this->getPosition()) > 1024) {
				$this->flagForDespawn();
			}

			if(!$inGround){
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

					if ($this->isLiquidInBoundingBox($this->getWorld(), $bb2, VanillaBlocks::WATER())) {
						$d10 += 0.2;
					}
				}

				if($this->getPosition()->isValid() and $d10 > 0) {
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

						if($this->ticksCatchableDelay <= 0){
							$this->broadcastAnimation(new FishingHookHookAnimation($this));

							$this->motion->y -= 0.2;
							$this->ticksCatchable = mt_rand(10, 30);
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
								if($this->random->nextFloat() < 0.15) {
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
						$this->ticksCaughtDelay = mt_rand(100, 900);
						$this->ticksCaughtDelay -= 20 * 5; // TODO: Lure
					}

					if($this->ticksCatchable > 0){
						$this->motion->y -= ($this->random->nextFloat() * $this->random->nextFloat() * $this->random->nextFloat()) * 0.2;
					}
				}

				$d11 = $d10 * 2.0 - 1.0;
				$this->motion->y += 0.04 * $d11;

				if($d10 > 0.0){
					$f6 = $f6 * 0.9;
					$this->motion->y *= 0.8;
				}

				$this->motion->x *= $f6;
				$this->motion->y *= $f6;
				$this->motion->z *= $f6;
			}
		}else{
			$this->flagForDespawn();
		}

		return $hasUpdate;
	}

	public function onDispose() : void{
		$owner = $this->getOwningEntity();
		if($owner instanceof Player){
			Loader::getInstance()->setFishingHook($owner, null);
		}
		$this->dismountEntity();
	}

	public function handleHookRetraction() : void{
		$angler = $this->getOwningEntity();
		if($this->getPosition()->isValid() and $angler instanceof Player){
			if($this->getRidingEntity() != null){
				$ev = new PlayerFishEvent(Loader::getInstance(), $angler, $this, PlayerFishEvent::STATE_CAUGHT_ENTITY);
				$ev->call();

				if(!$ev->isCancelled()){
					$d0 = $angler->getPosition()->getX() - $this->getPosition()->getX();
					$d2 = $angler->getPosition()->getY() - $this->getPosition()->getY();
					$d4 = $angler->getPosition()->getZ() - $this->getPosition()->getZ();
					$d6 = sqrt($d0 * $d0 + $d2 * $d2 + $d4 * $d4);
					$d8 = 0.1;
					$this->getRidingEntity()->setMotion(new Vector3($d0 * $d8, $d2 * $d8 + sqrt($d6) * 0.08, $d4 * $d8));
				}
			}elseif($this->ticksCatchable > 0){
				// TODO: Random weighted items
				$items = [
					VanillaItems::RAW_FISH()->getId(), VanillaItems::PUFFERFISH()->getId(), VanillaItems::RAW_SALMON()->getId(), VanillaItems::CLOWNFISH()->getId()
				];
				$randomFish = $items[mt_rand(0, count($items) - 1)];
				$results = [ItemFactory::getInstance()->get($randomFish)];

				$ev = new PlayerFishEvent(Loader::getInstance(), $angler, $this, PlayerFishEvent::STATE_CAUGHT_FISH, $this->random->nextBoundedInt(6) + 1, $results);
				$ev->call();

				if(!$ev->isCancelled()){
					$results = $ev->getItemsResult();
					foreach ($results as $result)
					{
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

			$this->flagForDespawn();
		}
	}

	public function isLiquidInBoundingBox(World $world, AxisAlignedBB $bb, Liquid $material) : bool{
		$minX = (int) floor($bb->minX);
		$minY = (int) floor($bb->minY);
		$minZ = (int) floor($bb->minZ);
		$maxX = (int) floor($bb->maxX + 1);
		$maxY = (int) floor($bb->maxY + 1);
		$maxZ = (int) floor($bb->maxZ + 1);

		for($x = $minX; $x < $maxX; ++$x) {
			for($y = $minY; $y < $maxY; ++$y) {
				for($z = $minZ; $z < $maxZ; ++$z) {
					$block = $world->getBlockAt($x, $y, $z);

					if($block instanceof $material) {
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
}