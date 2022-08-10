<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward\provider;

use Exception;
use Generator;
use Nglam2911\DailyReward\DailyReward;
use pocketmine\player\Player;
use pocketmine\Server;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class SqliteProvider{
	protected const INIT = "dailyreward.init";
	protected const REGISTER = "dailyreward.register";
	protected const UPDATE = "dailyreward.update";
	protected const SELECT = "dailyreward.select";
	protected const REMOVE = "dailyreward.remove";

	protected DataConnector $database;

	public function init() : void{
		try{
			$this->database = libasynql::create(DailyReward::getInstance(), DailyReward::getInstance()->getConfig()->get("database"), [
				"sqlite" => "sqlite.sql"
			]);
			$this->database->executeGeneric(self::INIT);
		}catch(Exception){
			DailyReward::getInstance()->getLogger()->error("Failed create database.");
			Server::getInstance()->getPluginManager()->disablePlugin(DailyReward::getInstance());
		}
	}

	protected function asyncSelect(string $query = "", array $args = []) : Generator{
		return yield $this->database->asyncSelect($query, $args);
	}

	/**
	 * @param Player $player
	 *
	 * @return Generator<null|UserDataInfo>
	 */
	public function getUserData(Player $player) : Generator{
		$name = $player->getName();
		$data = yield $this->asyncSelect(self::SELECT, [
			"player" => $name
		]);
		if (empty($data)){
			return yield null;
		}
		return yield new UserDataInfo($player, (int)$data["Streak"], (int)$data["Claimtime"]);
	}

	public function register(Player $player) : void{
		$name = $player->getName();
		$this->database->executeChange(self::REGISTER, [
			"player" => $name,
			"streak" => 0,
			"claimtime" => 0
		]);
	}

	public function rawUpdate(Player $player, int $streak, int $claimtime) : void{
		$name = $player->getName();
		$this->database->executeChange(self::UPDATE, [
			"player" => $name,
			"streak" => $streak,
			"claimtime" => $claimtime
		]);
	}

	public function update(UserDataInfo $userData) : void{
		$this->rawUpdate($userData->getPlayer(), $userData->getStreak(), $userData->getLastClaimtime());
	}

	public function remove(Player $player) : void{
		$name = $player->getName();
		$this->database->executeChange(self::REMOVE, [
			"player" => $name
		]);
	}

	public function close() : void{
		$this->database->close();
	}


}