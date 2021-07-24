<?php

namespace SkillLevel;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

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
		$data = $this->getSkillLevel()->getProvider()->getPlayerData($player);
		if ($data == []) $this->getSkillLevel()->getProvider()->loadPlayerData($player);
	}
}