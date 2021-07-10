<?php

namespace SkillLevel\provider;

use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SkillLevel\SkillLevel;

class Sqlite3Provider
{
	public const INIT_TABLE = "skill.init";
	public const LOAD_PLAYER = "skill.loadplayer";
	public const REGISTER = "skill.register";
	public const UNREGISTER = "skill.unregister";
	/*public const UPDATE_MINING_LEVEL = "skill.update.mining.level";
	public const UPDATE_MINING_EXP = "skill.update.mining.exp";
	public const UPDATE_FISHING_LEVEL = "skill.update.fishing.level";
	public const UPDATE_FISHING_EXP = "skill.update.fishing.exp";
	public const UPDATE_FARMING_LEVEL = "skill.update.farming.level";
	public const UPDATE_FARMING_EXP = "skill.update.farming.exp";
	public const UPDATE_FORAGING_LEVEL = "skill.update.foraging.level";
	public const UPDATE_FORAGING_EXP = "skill.update.foraging.exp";*/

	private DataConnector $database;

	private SkillLevel $skillLevel;

	public function __construct(SkillLevel $skillLevel)
	{
		$this->skillLevel = $skillLevel;
		$this->register();
	}

	public function getSkillLevel(): SkillLevel
	{
		return $this->skillLevel;
	}

	public function register(): void
	{
		$this->database = libasynql::create($this->getSkillLevel(), $this->getSkillLevel()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);

		$this->database->executeGeneric(self::INIT_TABLE);


	}

	public function save()
	{
		if(isset($this->database)) $this->database->close();
	}

	public function getPlayerData(Player $player, callable $callable) : void
	{
		$name = $player->getName();
		$data = [];
		$this->database->executeSelect(self::LOAD_PLAYER, ["player" => $name], $callable);
	}

	public function registerPlayerData (Player $player)
	{
		$name = $player;

		$this->database->executeChange(self::REGISTER, [
			"player" => $name,
			"mininglevel" => 1,
			"miningexp" => 0,
			"fishinglevel" => 1,
			"fishingexp" => 0,
			"farminglevel" => 1,
			"farmingexp" => 0,
			"foraginglevel" => 1,
			"foragingexp" => 0
		]);
	}

	public function unregisterPlayerData (Player $player)
	{
		$this->database->executeChange(self::UNREGISTER, [
			"player" => $player->getName()
		]);
	}


}
