<?php
declare(strict_types=1);

namespace FishingModule\event;

use FishingModule\entity\FishingHook;
use FishingModule\Loader;
use pocketmine\entity\Human;
use pocketmine\event\plugin\PluginEvent;

class FishingHookHookEvent extends PluginEvent{

	protected Human $entity;
	protected FishingHook $hook;

	public function __construct(Human $entity, FishingHook $hook){
		$this->entity = $entity;
		$this->hook = $hook;
		parent::__construct(Loader::getInstance());
	}

	public function getEntity() : Human{
		return $this->entity;
	}

	public function getFishingHook() : FishingHook{
		return $this->hook;
	}
}