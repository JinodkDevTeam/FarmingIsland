<?php
declare(strict_types=1);

namespace AutionHouse\provider;

use AutionHouse\aution\Aution;
use AutionHouse\aution\Bid;
use AutionHouse\Loader;
use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected const INIT_AUTION = "aution.init.aution";
	protected const INIT_BID = "aution.init.bid";
	protected const REMOVE_AUTION = "aution.remove.aution";
	protected const REMOVE_BID = "aution.remove.bid";
	protected const REGISTER_AUTION = "aution.register.aution";
	protected const REGISTER_BID = "aution.register.bid";
	protected const UPDATE_AUTION_EXPIRED = "aution.update.aution.expired";
	protected const UPDATE_AUTION_BID_PRICE = "aution.update.bid.price";
	protected const SELECT_AUTION_ID = "aution.select.aution.id";
	protected const SELECT_AUTION_PLAYER = "aution.select.aution.player";
	protected const SELECT_AUTION_ALL = "aution.select.aution.all";
	protected const SELECT_AUTION_ALL_NO_EXPIRED = "aution.select.aution.all.no-expired";
	protected const SELECT_AUTION_ALL_EXPIRED = "aution.select.aution.all.expired";
	protected const SELECT_BID_ID = "aution.select.bid.id";
	protected const SELECT_BID_PLAYER = "aution.select.bid.player";

	protected DataConnector $db;
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	public function init(): void{
		$this->db = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);
		$this->db->executeGeneric(self::INIT_AUTION);
		$this->db->executeGeneric(self::INIT_BID);
	}

	public function close(): void{
		if (isset($this->db)) $this->db->close();
	}

	protected function asyncSelect(string $query, array $args) : Generator{
		$this->db->executeSelect($query, $args, yield, yield Await::REJECT);
		return Await::ONCE;
	}

	protected function executeChange(string $query, array $args): void{
		$this->db->executeChange($query, $args);
	}

	public function removeAution(int $id): void{
		$this->executeChange(self::REMOVE_AUTION, [
			"id" => $id
		]);
	}

	public function removeBid(int $id): void{
		$this->executeChange(self::REMOVE_BID, [
			"id" => $id
		]);
	}

	public function registerAution(Aution $aution): void{
		$this->executeChange(self::REGISTER_AUTION, [
			"player" => $aution->getPlayer(),
			"item" => $aution->getItem(),
			"price" => $aution->getPrice(),
			"time" => $aution->getTime()
		]);
	}

	public function registerBid(Bid $bid): void{
		$this->executeChange(self::REGISTER_BID, [
			"player" => $bid->getPlayer(),
			"id" => $bid->getAutionId(),
			"price" => $bid->getBidPrice()
		]);
	}

	public function updateAutionExpired(Aution $aution): void{
		$this->executeChange(self::UPDATE_AUTION_EXPIRED, [
			"id" => $aution->getId(),
			"expired" => $aution->isExpired()
		]);
	}

	public function updateBidPrice(Bid $bid): void{
		$this->executeChange(self::UPDATE_AUTION_BID_PRICE, [
			"player" => $bid->getPlayer(),
			"id" => $bid->getAutionId(),
			"price" => $bid->getBidPrice()
		]);
	}

	public function selectAutionID(int $id): Generator{
		return $this->asyncSelect(self::SELECT_AUTION_ID, ["id" => $id]);
	}

	public function selectAutionAll(): Generator{
		return $this->asyncSelect(self::SELECT_AUTION_ALL, []);
	}

	public function selectAutionAllNoExpired(): Generator{
		return $this->asyncSelect(self::SELECT_AUTION_ALL_NO_EXPIRED, []);
	}

	public function selectAutionAllExpired(): Generator{
		return $this->asyncSelect(self::SELECT_AUTION_ALL_EXPIRED, []);
	}

	public function selectAutionPlayer(string $player): Generator{
		return $this->asyncSelect(self::SELECT_AUTION_PLAYER, ["player" => $player]);
	}

	public function selectBidId(int $id): Generator{
		return $this->asyncSelect(self::SELECT_BID_ID, ["id" => $id]);
	}

	public function selectBidPlayer(string $player): Generator{
		return $this->asyncSelect(self::SELECT_BID_PLAYER, ["player" => $player]);
	}
}