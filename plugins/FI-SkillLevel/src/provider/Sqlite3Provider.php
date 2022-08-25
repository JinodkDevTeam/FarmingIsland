<?php
declare(strict_types=1);

namespace SkillLevel\provider;

use Exception;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;
use SkillLevel\Skill;
use SkillLevel\SkillLevel;
use SOFe\AwaitGenerator\Await;
use Throwable;

class Sqlite3Provider{
	public const INIT_TABLE = "skill.init";
	public const LOAD_PLAYER = "skill.loadplayer";
	public const REGISTER = "skill.register";
	public const UNREGISTER = "skill.unregister";

	private DataConnector $database;

	private SkillLevel $skillLevel;

	public function __construct(SkillLevel $skillLevel){
		$this->skillLevel = $skillLevel;
	}

	public function register() : void{
		try{
			$this->getSkillLevel()->getLogger()->info("Creating DataBase... (Sqlite3)");
			$this->database = libasynql::create($this->getSkillLevel(), $this->getSkillLevel()->getConfig()->get("database"), [
				"sqlite" => "sqlite.sql"
			]);
			$this->getSkillLevel()->getLogger()->info("DataBase Created ! (Sqlite3)");

			$this->database->executeGeneric(self::INIT_TABLE);
		}catch(SqlError $error){
			$this->getSkillLevel()->getLogger()->error($error->getMessage());
		}finally{
			$this->database->waitAll();
		}
	}

	public function getSkillLevel() : SkillLevel{
		return $this->skillLevel;
	}

	public function save() : void{
		if(isset($this->database)) {
			$this->database->waitAll();
			$this->database->close();
		}
	}

	public function addPlayerData(Player $player, array $data = []) : Generator{
		$name = $player->getName();
		if($data == []){
			$data["MiningLevel"] = 1;
			$data["MiningExp"] = 0;
			$data["FishingLevel"] = 1;
			$data["FishingExp"] = 0;
			$data["FarmingLevel"] = 1;
			$data["FarmingExp"] = 0;
			$data["ForagingLevel"] = 1;
			$data["ForagingExp"] = 0;
		}
		try{
			yield $this->database->asyncChange(self::REGISTER, [
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
		}catch(Exception $exception){
			$this->getSkillLevel()->getLogger()->logException($exception);
			$this->getSkillLevel()->getLogger()->error("Failed to add player data: " . $player->getName());
		}
	}

	public function unregisterPlayerData(Player $player) : void{
		$this->database->executeChange(self::UNREGISTER, [
			"player" => $player->getName()
		]);
	}

	public function updateLevel(Player $player, Skill $skill, int $level) : Generator{
		$query = "skill.update." . $skill->getName() . ".level";

		yield $this->database->asyncChange($query, [
			"player" => $player->getName(),
			"level" => $level
		]);
	}

	public function updateExp(Player $player, Skill $skill, int $exp) : Generator{
		$query = "skill.update." . $skill->getName(). ".exp";

		yield $this->database->asyncChange($query, [
			"player" => $player->getName(),
			"exp" => $exp
		]);
	}

	public function loadPlayer(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->database->asyncSelect(Sqlite3Provider::LOAD_PLAYER, ["player" => $player->getName()]);
			if(empty($data)){
				yield $this->addPlayerData($player);
			}
			$data = yield from $this->database->asyncSelect(Sqlite3Provider::LOAD_PLAYER, ["player" => $player->getName()]);
			$this->getSkillLevel()->getPlayerSkillLevelManager()->registerPlayer($player, $data[0]);
		}, function(){ }, function(Throwable $err){
			$this->getSkillLevel()->getLogger()->logException($err);
		});
	}

	public function unloadPlayer(Player $player) : void{
		$data = $this->getSkillLevel()->getPlayerSkillLevelManager()->getPlayerSkillLevel($player);
		if ($data === null){
			$this->getSkillLevel()->getLogger()->error("Unable to save data of player " . $player->getName());
			return;
		}
		Await::f2c(function() use ($player, $data){
			foreach(Skill::getAll() as $skill){
				yield $this->updateExp($player, $skill, $data->getSkillExp($skill));
				yield $this->updateLevel($player, $skill, $data->getSkillLevel($skill));
			}
			$this->getSkillLevel()->getPlayerSkillLevelManager()->unregisterPlayer($player);
		});
	}
}
