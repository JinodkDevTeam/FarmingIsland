<?php
declare(strict_types=1);

namespace FishingModule;

use FishingModule\entity\FishingHook;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;

class EventListener implements Listener{

	/**
	 * @param EntityDamageEvent $event
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 */
	public function onDamage(EntityDamageEvent $event) : void{
		if ($event->getEntity() instanceof FishingHook){
			$event->cancel();
		}
	}
}