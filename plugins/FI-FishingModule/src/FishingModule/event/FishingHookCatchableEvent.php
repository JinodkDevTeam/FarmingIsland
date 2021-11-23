<?php
declare(strict_types=1);

namespace FishingModule\event;

use FishingModule\entity\FishingHook;
use FishingModule\Loader;
use pocketmine\entity\Human;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\plugin\Plugin;

class FishingHookCatchableEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

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