<?php
declare(strict_types=1);

namespace Bazaar\provider;

use Bazaar\Bazaar;
use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider implements Provider{

	public const INIT_BUY = "bazaar.init.buy";
	public const INIT_SELL = "bazaar.init.sell";
	public const REGISTER_BUY = "bazaar.register.buy";
	public const REGISTER_SELL = "bazaar.register.sell";
	public const REMOVE_BUY = "bazaar.remove.buy";
	public const REMOVE_SELL = "bazaar.remove.sell";
	public const SELECT_BUY_ID = "bazaar.select.buy.id";
	public const SELECT_BUY_PLAYER = "bazaar.select.buy.player";
	public const SELECT_BUY_ITEMID_UNSORT = "bazaar.select.buy.itemid.unsort";
	public const SELECT_BUY_ITEMID_SORT_PRICE = "bazaar.select.buy.itemid.sort.price";
	public const SELECT_SELL_ID = "bazaar.select.sell.id";
	public const SELECT_SELL_PLAYER = "bazaar.select.sell.player";
	public const SELECT_SELL_ITEMID_UNSORT = "bazaar.select.sell.itemid.unsort";
	public const SELECT_SELL_ITEMID_SORT_PRICE = "bazaar.select.sell.itemid.sort.price";
	public const UPDATE_BUY_FILLED = "bazaar.update.buy.filled";
	public const UPDATE_SELL_FILLED = "bazaar.update.sell.filled";
	public const UPDATE_BUY_ISFILLED = "bazaar.update.buy.isfilled";
	public const UPDATE_SELL_ISFILLED = "bazaar.update.sell.isfilled";


	/** @var Bazaar */
	private Bazaar $bazaar;
	/** @var DataConnector */
	private DataConnector $database;

	/**
	 * SqliteProvider constructor.
	 *
	 * @param Bazaar $bazaar
	 */
	public function __construct(Bazaar $bazaar){
		$this->bazaar = $bazaar;
	}

	/**
	 * @description Load everything...
	 */
	public function init() : void{
		$this->database = libasynql::create($this->getBazaar(), $this->getBazaar()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);

		$this->database->executeGeneric(self::INIT_BUY);
		$this->database->executeGeneric(self::INIT_SELL);
	}

	/**
	 * @return Bazaar
	 */
	private function getBazaar() : Bazaar{
		return $this->bazaar;
	}

	public function close() : void{
		if(isset($this->database)) $this->database->close();
	}

	public function asyncSelect(string $query, array $args) : Generator{
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function executeChange(string $query, array $args) : void{
		$this->database->executeChange($query, $args);
	}
}