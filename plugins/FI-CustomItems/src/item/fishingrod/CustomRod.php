<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\CustomItem;
use FishingModule\event\EntityFishEvent;
use FishingModule\event\FishingHookHookEvent;

class CustomRod extends CustomItem{

	public function onHook(FishingHookHookEvent $event) : void{
	}

	public function onFish(EntityFishEvent $event) : void{
	}
}