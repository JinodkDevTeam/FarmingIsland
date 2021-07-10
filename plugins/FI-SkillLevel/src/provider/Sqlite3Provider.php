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
		$this->database->executeSelect(self::LOAD_PLAYER, ["player" => $name], $callable);
	}

	public function loadPlayerData (Player $player, array $data = []): void
	{
		$name = $player;

		if ($data == [])
		{
			$data["MiningLevel"] = 1;
			$data["MiningExp"] = 0;
			$data["FishingLevel"] = 1;
			$data["FishingExp"] = 0;
			$data["FarmingLevel"] = 1;
			$data["FarmingExp"] = 0;
			$data["ForagingLevel"] = 1;
			$data["ForagingExp"] = 0;
 		}
		$this->database->executeChange(self::REGISTER, [
			"player" => $name,
			"mininglevel" => $data["MiningLevel"],
			"miningexp" => $data["MiningExp"],
			"fishinglevel" => $data["FishingLevel"],
			"fishingexp" => $data["FishingExp"],
			"farminglevel" => $data["FarmingLevel"],
			"farmingexp" => $data["FarmingExp"],
			"foraginglevel" => $data["ForagingLevel"],
			"foragingexp" => $data["ForagingExp"]
		]);
	}

	public function unregisterPlayerData (Player $player)
	{
		$this->database->executeChange(self::UNREGISTER, [
			"player" => $player->getName()
		]);
	}

	public function updateLevel(Player $player, int $skill_code, int $level): void
	{
		$query = "skill.update.".$this->IDParser($skill_code).".level";

		$this->database->executeChange($query, [
			"player" => $player->getName(),
			"level" => $level
		]);
	}

	public function updateExp(Player $player, int $skill_code, int $exp): void
	{
		$query = "skill.update.".$this->IDParser($skill_code).".exp";

		$this->database->executeChange($query, [
			"player" => $player->getName(),
			"exp" => $exp
		]);
	}

	public function IDParser(int $code): string
	{
		switch($code)
		{
			case SkillLevel::MINING:
				return "mine";
			case SkillLevel::FISHING:
				return "fishing";
			case SkillLevel::FARMING:
				return "farming";
			case SkillLevel::FORAGING:
				return "foraging";
			default:
				return "";
		}
	}


}
