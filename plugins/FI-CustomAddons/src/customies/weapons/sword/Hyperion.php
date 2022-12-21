<?php

declare(strict_types=1);

namespace CustomAddons\customies\weapons\sword;

use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\Liquid;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\ItemUseResult;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\sound\ExplodeSound;

class Hyperion extends Sword{

	public function getTexture() : string{
		return "fici_hyperion";
	}

	public function getBaseDamage() : int{
		return 260;
	}

	public function onClickAir(Player $player, Vector3 $directionVector) : ItemUseResult{
		$this->abilty($player);
		return ItemUseResult::SUCCESS();
	}

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		$this->abilty($player);
		return ItemUseResult::SUCCESS();
	}

	public function abilty(Player $player){
		$direction = $player->getDirectionVector();
		$pos = $player->getPosition();
		$world = $player->getWorld();
		for($i = 1; $i <= 8; $i++){
			$pos = $pos->addVector($direction);

			if((!$world->getBlock($pos) instanceof Air) and (!$world->getBlock($pos) instanceof Liquid)){
				$pos = $pos->subtractVector($direction);
				break;
			}
		}
		$player->teleport($pos);
		$world->addParticle($pos, new HugeExplodeParticle());
		$radius = 5;
		$bb = new AxisAlignedBB($pos->x - $radius, $pos->y - $radius, $pos->z - $radius, $pos->x + $radius, $pos->y + $radius, $pos->z + $radius);
		$entities = $world->getNearbyEntities($bb);
		//Damage entities in radius
		foreach($entities as $entity){
			if(!$entity instanceof Player){
				$event = new EntityDamageByEntityEvent($player, $entity, EntityDamageEvent::CAUSE_ENTITY_EXPLOSION, $this->getBaseDamage());
				$entity->attack($event);
			}
		}
		$world->addSound($pos, new ExplodeSound());
	}
}