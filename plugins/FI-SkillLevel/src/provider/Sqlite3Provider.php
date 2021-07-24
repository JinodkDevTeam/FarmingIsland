<?php

namespace SkillLevel\provider;

use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SkillLevel\SkillLevel;
use Exception;

class Sqlite3Provider
{
	public const INIT_TABLE = "skill.init";
	public const LOAD_PLAYER = "skill.loadplayer";
	public const REGISTER = "skill.register";
	public const UNREGISTER = "skill.unregister";

	private DataConnector $database;

	private SkillLevel $skillLevel;

	public function __construct(SkillLevel $skillLevel)
	{
		$this->skillLevel = $skillLevel;
	}

	public function getSkillLevel(): SkillLevel
	{
		return $this->skillLevel;
	}

	public function register(): void
	{
		$this->getSkillLevel()->getLogger()->info("Creating DataBase... (Sqlite3)");
		$this->database = libasynql::create($this->getSkillLevel(), $this->getSkillLevel()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);
		$this->getSkillLevel()->getLogger()->info("DataBase Created ! (Sqlite3)");

		$this->database->executeGeneric(self::INIT_TABLE);

	}

	public function save()
	{
		if(isset($this->database)) $this->database->close();
	}

	public function getPlayerData(Player $player) : array
	{
		$name = $player->getName();
		$data = [];
		$this->database->executeSelect(self::LOAD_PLAYER, ["player" => $name], function(array $rows) use (&$data)
		{
			var_dump($rows);
			if (isset($rows[0]))
			{
				$data = $rows[0];
			}
			else
			{
				$data = [];
			}
		});

		return $data;
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
		try
		{
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
		catch(Exception $exception)
		{
			$this->getSkillLevel()->getLogger()->error("Failed to register player data: " . $player->getName());
		}
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

	public function getLevel(Player $player, int $skill_code): int
	{
		$query = "skill.get.".$this->IDParser($skill_code).".level";
		$data = 0;

		$this->database->executeChange($query, [
			"player" => $player->getName(),
		], function(array $rows) use (&$data, $skill_code)
		{
			$data = (int)$rows[0][$this->IDLevelParser($skill_code)];
		});

		return $data;
	}

	public function getExp(Player $player, int $skill_code): int
	{
		$query = "skill.get.".$this->IDParser($skill_code).".exp";
		$data = 0;

		$this->database->executeChange($query, [
			"player" => $player->getName(),
		], function(array $rows) use (&$data, $skill_code)
		{
			$data = (int)$rows[0][$this->IDExpParser($skill_code)];
		});

		return $data;
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

	public function IDExpParser(int $code = 0): string
	{
		switch($code)
		{
			case SkillLevel::MINING:
				return "MineExp";
			case SkillLevel::FISHING:
				return "FishingExp";
			case SkillLevel::FARMING:
				return "FarmingExp";
			case SkillLevel::FORAGING:
				return "ForagingExp";
			default:
				return "";
		}
	}

	public function IDLevelParser(int $code = 0): string
	{
		switch($code)
		{
			case SkillLevel::MINING:
				return "MineLevel";
			case SkillLevel::FISHING:
				return "FishingLevel";
			case SkillLevel::FARMING:
				return "FarmingLevel";
			case SkillLevel::FORAGING:
				return "ForagingLevel";
			default:
				return "";
		}
	}


}
