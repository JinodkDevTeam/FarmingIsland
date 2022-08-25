<?php
declare(strict_types=1);

namespace SkillLevel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{
	private SkillLevel $skillLevel;

	public function __construct(SkillLevel $skillLevel){
		$this->skillLevel = $skillLevel;
	}

	/**
	 * @param PlayerJoinEvent $event
	 *
	 * @priority HIGHEST
	 */
	public function onJoin(PlayerJoinEvent $event): void{
		$player = $event->getPlayer();
		$this->getSkillLevel()->getProvider()->loadPlayer($player);
	}

	public function getSkillLevel() : SkillLevel{
		return $this->skillLevel;
	}

	public function onQuit(PlayerQuitEvent $event): void{
		$this->getSkillLevel()->getProvider()->unloadPlayer($event->getPlayer());
	}
}