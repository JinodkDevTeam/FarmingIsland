<?php

namespace SkillLevel;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use SkillLevel\provider\Sqlite3Provider;

class SkillLevel extends PluginBase
{
	public const MINING = 1;
	public const FISHING = 2;
	public const FARMING = 3;
	public const FORAGING = 4;

	private Sqlite3Provider $provider;

	public function getProvider(): Sqlite3Provider
	{
		return $this->provider;
	}

	public function onEnable() : void
	{
		$this->saveDefaultConfig();
		$this->provider = new Sqlite3Provider($this);
		/*$this->getProvider()->register();*/
	}

	public function onDisable() : void
	{
		$this->getProvider()->save();
	}

	public function getPlayerSkillLevel(Player $player, int $skill_id): int
	{
		return $this->getProvider()->getLevel($player, $skill_id);
	}

	public function getPlayerSkillExp(Player $player, int $skill_id): int
	{
		return $this->getProvider()->getExp($player, $skill_id);
	}

}
