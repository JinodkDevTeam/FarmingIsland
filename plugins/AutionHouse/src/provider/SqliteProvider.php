<?php
declare(strict_types=1);

namespace AutionHouse\provider;

use AutionHouse\Loader;
use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	public const INIT_AUTION = "aution.init.aution";
	public const INIT_BID = "aution.init.bid";
	public const REMOVE_AUTION = "aution.remove.aution";
	public const REMOVE_BID = "aution.remove.bid";
	public const REGISTER_AUTION = "aution.register.aution";
	public const REGISTER_BID = "aution.register.bid";
	public const UPDATE_AUTION_EXPIRED = "aution.update.aution.expired";
	public const UPDATE_AUTION_BID_PRICE = "aution.update.bid.price";
	public const SELECT_AUTION_ID = "aution.select.aution.id";
	public const SELECT_AUTION_PLAYER = "aution.select.aution.player";
	public const SELECT_AUTION_ALL = "aution.select.aution.all";
	public const SELECT_AUTION_ALL_NO_EXPIRED = "aution.select.aution.all.no-expired";
	public const SELECT_AUTION_ALL_EXPIRED = "aution.select.aution.all.expired";
	public const SELECT_BID_ID = "aution.select.bid.id";
	public const SELECT_BID_PLAYER = "aution.select.bid.player";

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

	public function asyncSelect(string $query, array $args) : Generator{
		$this->db->executeSelect($query, $args, yield, yield Await::REJECT);
		return Await::ONCE;
	}

	public function executeChange(string $query, array $args): void{
		$this->db->executeChange($query, $args);
	}
}