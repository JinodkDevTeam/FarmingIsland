<?php
declare(strict_types=1);

namespace Bazaar\provider;

use Bazaar\Bazaar;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class SqliteProvider implements Provider{

	public const INIT = "bazaar.init";
	public const REGISTER_BUY = "bazaar.register.buy";
	public const REGISTER_SELL = "bazaar.register.sell";

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
	 * @return Bazaar
	 */
	private function getBazaar(): Bazaar{
		return $this->bazaar;
	}

	/**
	 * @description Load everything...
	 */
	public function init() : void{
		$this->database = libasynql::create($this->getBazaar(), $this->getBazaar()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);
	}

	public function close() : void{
		if (isset($this->database)) $this->database->close();
	}
}