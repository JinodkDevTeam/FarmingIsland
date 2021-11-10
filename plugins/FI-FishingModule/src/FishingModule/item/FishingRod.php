<?php

declare(strict_types=1);

namespace FishingModule\item;

use FishingModule\entity\FishingHook;
use FishingModule\event\EntityFishEvent;
use FishingModule\Loader;
use pocketmine\item\Durable;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class FishingRod extends Durable{
	public function getMaxStackSize() : int{
		return 1;
	}

	public function getMaxDurability() : int{
		return 65;
	}

	public function onClickAir(Player $player, Vector3 $directionVector) : ItemUseResult{
		if(Loader::getInstance()->getFishingHook($player) == null){
			if($this->spawnFishingHook($player, $directionVector)){
				return ItemUseResult::SUCCESS();
			}else{
				return ItemUseResult::FAIL();
			}
		}else{
			$hook = Loader::getInstance()->getFishingHook($player);
			$hook?->onRetraction();
			$this->applyDamage(1);
		}
		return ItemUseResult::SUCCESS();
	}

	protected function spawnFishingHook(Player $player, Vector3 $direction) : bool{
		$location = $player->getLocation();
		$location->y += $player->getEyeHeight();
		$entity = new FishingHook($location, $player);
		$ev = new EntityFishEvent(Loader::getInstance(), $player, $entity, EntityFishEvent::STATE_FISHING);
		$ev->call();
		if($ev->isCancelled()){
			return false;
		}
		$entity->setMotion($direction->multiply(1.4));
		$entity->spawnToAll();
		Loader::getInstance()->setFishingHook($player, $entity);
		return true;
	}
}
