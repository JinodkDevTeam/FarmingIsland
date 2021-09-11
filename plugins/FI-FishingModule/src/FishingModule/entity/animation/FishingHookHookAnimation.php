<?php

declare(strict_types=1);

namespace FishingModule\entity\animation;

use FishingModule\entity\FishingHook;
use pocketmine\entity\animation\Animation;
use pocketmine\network\mcpe\protocol\ActorEventPacket;

final class FishingHookHookAnimation implements Animation{

	protected FishingHook $fishinghook;

	public function __construct(FishingHook $hook){
		$this->fishinghook = $hook;
	}

	public function encode() : array{
		return [
			ActorEventPacket::create($this->fishinghook->getId(), ActorEventPacket::FISH_HOOK_HOOK, 0)
		];
	}
}