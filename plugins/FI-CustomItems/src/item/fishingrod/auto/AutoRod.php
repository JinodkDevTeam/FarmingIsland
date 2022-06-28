<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod\auto;

use CustomItems\item\fishingrod\CustomRod;
use CustomItems\Loader;
use FishingModule\event\FishingHookHookEvent;
use FishingModule\item\FishingRod;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;

class AutoRod extends CustomRod{
	public function onHook(FishingHookHookEvent $event) : void{
		$task = new ClosureTask(function() use ($event) : void{
			$item = $event->getEntity()->getInventory()->getItemInHand();
			if ($item instanceof FishingRod){
				$player = $event->getEntity();
				if ($player instanceof Player){
					$item->onClickAir($player, $player->getDirectionVector());
					$item->onClickAir($player, $player->getDirectionVector());
				}
			}
		});
		Loader::getInstance()->getScheduler()->scheduleDelayedTask($task, 5);
	}
}