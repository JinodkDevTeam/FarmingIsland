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
use SOFe\AwaitGenerator\Await;

class SqliteProvider{
	protected const INIT = "dailyreward.init";
	protected const REGISTER = "dailyreward.register";
	protected const UPDATE = "dailyreward.update";
	protected const SELECT = "dailyreward.select";
	protected const REMOVE = "dailyreward.remove";

	protected DataConnector $database;

	public function init() : void{
		try{
			Await::f2c(function(){
				$this->database = libasynql::create(DailyReward::getInstance(), DailyReward::getInstance()->getConfig()->get("database"), [
					"sqlite" => "sqlite.sql"
				]);
				yield from $this->database->asyncGeneric(self::INIT);
			});
		}catch(Exception){
			DailyReward::getInstance()->getLogger()->error("Failed create database.");
			Server::getInstance()->getPluginManager()->disablePlugin(DailyReward::getInstance());
		}finally{
			$this->database->waitAll();
		}
	}

	/**
	 * @param Player $player
	 *
	 * @return Generator<null|UserDataInfo>
	 */
	public function getUserData(Player $player) : Generator{
		$name = $player->getName();
		$data = yield from $this->database->asyncSelect(self::SELECT, [
			"player" => $name
		]);
		if (empty($data)){
			return null;
		}
		return new UserDataInfo($player, (int)$data[0]["Streak"], (int)$data[0]["ClaimTime"]);
	}

	public function asyncRegister(Player $player) : Generator{
		$name = $player->getName();
		yield from $this->database->asyncChange(self::REGISTER, [
			"player" => $name,
			"streak" => 0,
			"claimtime" => 0
		]);
	}

	public function asyncRawUpdate(Player $player, int $streak, int $claimtime) : Generator{
		$name = $player->getName();
		yield from $this->database->asyncChange(self::UPDATE, [
			"player" => $name,
			"streak" => $streak,
			"claimtime" => $claimtime
		]);
	}

	public function asyncUpdate(UserDataInfo $userData) : Generator{
		yield from $this->asyncRawUpdate($userData->getPlayer(), $userData->getStreak(), $userData->getLastClaimtime());
	}

	public function asyncRemove(Player $player) : Generator{
		$name = $player->getName();
		yield from $this->database->asyncChange(self::REMOVE, [
			"player" => $name
		]);
	}

	public function close() : void{
		$this->database->waitAll();
		$this->database->close();
	}


}