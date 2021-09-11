<?php

declare(strict_types=1);

namespace FishingModule\item;

use FishingModule\entity\FishingHook;
use FishingModule\event\PlayerFishEvent;
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
			$hook?->handleHookRetraction();
			$this->applyDamage(1);
		}
		return ItemUseResult::SUCCESS();
	}

	protected function spawnFishingHook(Player $player, Vector3 $direction) : bool{
		$entity = new FishingHook($player->getLocation(), $player);
		$ev = new PlayerFishEvent(Loader::getInstance(), $player, $entity, PlayerFishEvent::STATE_FISHING);
		$ev->call();
		if($ev->isCancelled()){
			return false;
		}
		$entity->spawnToAll();
		$entity->setMotion($direction->multiply(1.4));
		Loader::getInstance()->setFishingHook($player, $entity);
		return true;
	}
}
