<?php
declare(strict_types=1);

namespace Bank\provider;

use Bank\Bank;
use Exception;
use Generator;
use pocketmine\player\Player;
use pocketmine\Server;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{
	public const INIT = "bank.init";
	public const REGISTER = "bank.register";
	public const GET = "bank.get";
	public const REMOVE = "bank.remove";
	public const UPDATE_BALANCE = "bank.update.balance";
	public const GET_ALL = "bank.getall";
	public const TOP = "bank.top";
	public const UPDATE_UPGRADE = "bank.update.upgrade";

	private DataConnector $database;
	private Bank $bank;

	public function __construct(Bank $bank){
		$this->bank = $bank;
	}

	public function init() : void{
		try{
			$this->database = libasynql::create($this->getBank(), $this->getBank()->getConfig()->get("database"), [
				"sqlite" => "sqlite.sql"
			]);
			$this->database->executeGeneric(self::INIT);
		}catch(Exception){

			$this->getBank()->getLogger()->error("Failed create database.");
			Server::getInstance()->getPluginManager()->disablePlugin($this->bank);
		}
	}

	private function getBank() : Bank{
		return $this->bank;
	}

	public function close() : void{
		if(isset($this->database)) $this->database->close();
	}

	public function remove(Player|string $player) : void{
		if($player instanceof Player) $player = $player->getName();

		$this->database->executeChange(self::REMOVE, [
			"player" => $player
		]);
	}

	public function updateBalance(Player|string $player, float $value) : void{
		if($player instanceof Player) $player = $player->getName();

		$this->database->executeChange(self::UPDATE_BALANCE, [
			"player" => $player,
			"value" => $value
		]);
	}

	public function updateUpgrade(Player|string $player, int $upgrade) : void{
		if($player instanceof Player) $player = $player->getName();

		$this->database->executeChange(self::UPDATE_UPGRADE, [
			"player" => $player,
			"value" => $upgrade
		]);
	}

	public function register(Player|string $player, float $value = 0) : void{
		if($player instanceof Player) $player = $player->getName();

		$this->database->executeChange(self::REGISTER, [
			"player" => $player,
			"value" => $value,
			"upgrade" => 1
		]);
	}

	public function get(Player|string $player) : Generator{
		if($player instanceof Player) $player = $player->getName();

		return yield $this->asyncSelect(self::GET, [
			"player" => $player
		]);
	}

	public function asyncSelect(string $query, array $args = []) : Generator{
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function getAll() : Generator{
		return yield $this->asyncSelect(self::GET_ALL);
	}

	public function getBankLimit(int $upgrade) : float{
		return (float) $this->getBank()->getConfig()->get("upgrades")[$upgrade];
	}

	public function getUpgradeName(int $upgrade) : string{
		return $this->getBank()->getConfig()->get("upgrades-name")[$upgrade];
	}

	public function getMaxUpgrade() : int{
		return $this->getBank()->getConfig()->get("max-upgrades");
	}

	public function getUpgradeCost(int $upgrade) : float{
		return (float) $this->getBank()->getConfig()->get("upgrades_cost")[$upgrade];
	}
}