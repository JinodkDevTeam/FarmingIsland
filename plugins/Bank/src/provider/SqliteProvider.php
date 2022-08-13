<?php
declare(strict_types=1);

namespace Bank\provider;

use Bank\Bank;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;

class SqliteProvider{
	protected const INIT = "bank.init";
	protected const REGISTER = "bank.register";
	protected const GET = "bank.get";
	protected const REMOVE = "bank.remove";
	protected const UPDATE_BALANCE = "bank.update.balance";
	protected const GET_ALL = "bank.getall";
	protected const TOP = "bank.top";
	protected const UPDATE_UPGRADE = "bank.update.upgrade";

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
		}catch(SqlError $error){
			$this->getBank()->getLogger()->error($error->getMessage());
		}finally{
			$this->database->waitAll();
		}
	}

	private function getBank() : Bank{
		return $this->bank;
	}

	public function close() : void{
		if(isset($this->database)){
			$this->database->waitAll();
			$this->database->close();
		}
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

	public function asyncRegister(Player|string $player, float $value = 0) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield $this->database->asyncChange(self::REGISTER, [
			"player" => $player,
			"value" => $value,
			"upgrade" => 1
		]);
	}

	public function get(Player|string $player) : Generator{
		if($player instanceof Player) $player = $player->getName();

		return yield from $this->database->asyncSelect(self::GET, [
			"player" => $player
		]);
	}

	public function getAll() : Generator{
		return yield from $this->database->asyncSelect(self::GET_ALL);
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