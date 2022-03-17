<?php
declare(strict_types=1);

namespace IslandMaker;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class EventListener implements Listener{

	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	public function onInteract(PlayerInteractEvent $event) : void{
		$player = $event->getPlayer();
		if ($this->getLoader()->getStatus($player) == Loader::POS1){
			$this->getLoader()->pos1 = $event->getBlock()->getPosition();
			$this->getLoader()->setStatus($player, Loader::NONE);
			$player->sendMessage("[IslandMaker]Set pos1 successful");
		}
		if ($this->getLoader()->getStatus($player) == Loader::POS2){
			$this->getLoader()->pos2 = $event->getBlock()->getPosition();
			$this->getLoader()->setStatus($player, Loader::NONE);
			$player->sendMessage("[IslandMaker]Set pos2 successful");
		}
	}
}