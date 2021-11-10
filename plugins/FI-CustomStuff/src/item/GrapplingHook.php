<?php
declare(strict_types=1);

namespace CustomStuff\item;

use FishingModule\event\PlayerFishEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;

class GrapplingHook implements Listener{

	public function onFish(PlayerFishEvent $event){
		$item = $event->getPlayer()->getInventory()->getItemInHand();
		$nbt = $item->getNamedTag();
		if($nbt->getTag("CustomItem") == null){
			return;
		}
		if($nbt->getTag("CustomItem")->getValue() == "GrapplingHook"){
			if($event->getState() == PlayerFishEvent::STATE_FISHING){
				return;
			}
			if($event->getState() !== PlayerFishEvent::STATE_CAUGHT_NOTHING){
				$event->cancel();
				return;
			}
			$angler = $event->getPlayer();
			$hook = $event->getFishingHook();
			$hook_pos = $hook->getPosition();
			$angler_pos = $angler->getPosition();
			$d0 = $hook_pos->x - $angler_pos->x;
			$d2 = $hook_pos->y - $angler_pos->y;
			$d4 = $hook_pos->z - $angler_pos->z;
			$d6 = sqrt($d0 * $d0 + $d2 * $d2 + $d4 * $d4);
			$d8 = 0.1;
			$vct = (new Vector3($d0 * $d8, $d2 * $d8 + sqrt($d6) * 0.08, $d4 * $d8))->multiply(2);
			$angler->setMotion($vct);
		}
	}
}
