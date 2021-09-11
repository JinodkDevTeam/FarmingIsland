<?php

declare(strict_types=1);

namespace FishingModule\item;

use FishingModule\entity\FishingHook;
use FishingModule\event\PlayerFishEvent;
use FishingModule\Loader;
use pocketmine\entity\EntityDataHelper;
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
			$location = $player->getLocation();
			$location->add(0, $player->getEyeHeight() - 0.1, 0);
			$motion = $player->getDirectionVector();
			$motion->multiply(1.4);
			$hook = new FishingHook($location, $player, EntityDataHelper::createBaseNBT($location->asVector3(), $motion));
			($ev = new PlayerFishEvent(Loader::getInstance(), $player, $hook, PlayerFishEvent::STATE_FISHING))->call();
			if($ev->isCancelled()){
				$hook->flagForDespawn();
			}else{
				$hook->spawnToAll();
				$hook->setMotion($motion);
			}
			return ItemUseResult::SUCCESS();
		}else{
			$hook = Loader::getInstance()->getFishingHook($player);
			$hook->handleHookRetraction();
			$this->applyDamage(1);
		}

		return ItemUseResult::SUCCESS();
	}
}
