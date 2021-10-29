<?php
declare(strict_types=1);

namespace Backpack\provider;

use Backpack\Loader;
use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected DataConnector $database;
	protected Loader $loader;

	protected const INIT = "backpack.init";
	protected const REGISTER = "backpack.register";
	protected const REMOVE_ALL = "backpack.remove.all";
	protected const REMOVE_SLOT = "backpack.remove.slot";
	protected const UPDATE = "backpack.update";
	protected const SELECT_ALL = "backpack.select.all";
	protected const SELECT_PLAYER = "backpack.select.player";
	protected const SELECT_SLOT = "backpack.select.slot";


	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	protected function asyncSelect(string $query, array $args) : Generator{
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);
		return yield Await::ONCE;
	}

	public function init() : void{
		$this->database = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);
	}

	public function close() : void{
		if (isset($this->database)) $this->database->close();
	}
}