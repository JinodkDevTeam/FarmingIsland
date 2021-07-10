<?php

namespace SkillLevel;

use NgLamVN\SkillLevel\PlayerSkillLevel;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use SkillLevel\provider\Sqlite3Provider;

class SkillLevel extends PluginBase
{
	public const MINING = 1;
	public const FISHING = 2;
	public const FARMING = 3;
	public const FORAGING = 4;

	/** @var PlayerSkillLevel */
	private $playerData = [];

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

	public function getPlayerSkillData(Player $player): ?PlayerSkillLevel
	{
		if (isset($this->playerData[$player->getName()]))
		{
			return $this->playerData[$player->getName()];
		}
		return null;
	}

	public function setPlayerSkillData(Player $player, PlayerSkillLevel $data)
	{
		$this->playerData[$player->getName()] = $data;
	}
}
