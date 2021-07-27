<?php

namespace SkillLevel\provider;

use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SkillLevel\SkillLevel;
use Exception;
use SOFe\AwaitGenerator\Await;

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

	public function addPlayerData (Player $player, array $data = []): void
	{
		$name = $player->getName();

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
			$this->getSkillLevel()->getLogger()->logException($exception);
			$this->getSkillLevel()->getLogger()->error("Failed to add player data: " . $player->getName());
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

	public function IDParser(int $code): string
	{
		return match ($code) {
			SkillLevel::MINING => "mining",
			SkillLevel::FISHING => "fishing",
			SkillLevel::FARMING => "farming",
			SkillLevel::FORAGING => "foraging",
			default => "",
		};
	}

	public function asyncSelect(string $query, array $args = []): Generator
	{
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}
}
