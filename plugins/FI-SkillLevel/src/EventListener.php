<?php

namespace SkillLevel;

use pocketmine\event\block\BlockBreakEvent;
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

	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onBlockBreak(BlockBreakEvent $event)
	{
		$player = $event->getPlayer();
		$data = $this->getSkillLevel()->getPlayerSkillLevelManager()->getPlayerSkillLevel($player);

		$data->addSkillExp(SkillLevel::MINING, 1);

		if ($data->getSkillExp(SkillLevel::MINING) >= 100)
		{
			$data->setSkillExp(SkillLevel::MINING, 0);
			$data->setSkillLevel(SkillLevel::MINING, $data->getSkillLevel(SkillLevel::MINING) + 1);
		}

		$player->sendPopup("Mining " . $data->getSkillLevel(SkillLevel::MINING) . ": " . $data->getSkillExp(SkillLevel::MINING) . "/100 (+1)");
	}

	public function onQuit(PlayerQuitEvent $event)
	{
		$this->getSkillLevel()->unloadPlayer($event->getPlayer());
	}
}