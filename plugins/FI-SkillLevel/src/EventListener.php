<?php

namespace SkillLevel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener
{
	private SkillLevel $skillLevel;

	public function __construct(SkillLevel $skillLevel)
	{
		$this->skillLevel = $skillLevel;
	}

	public function getSkillLevel(): SkillLevel
	{
		return $this->skillLevel;
	}

	/**
	 * @param PlayerJoinEvent $event
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$this->getSkillLevel()->loadPlayer($player);
	}

	public function onQuit(PlayerQuitEvent $event)
	{
		$this->getSkillLevel()->unloadPlayer($event->getPlayer());
	}
}