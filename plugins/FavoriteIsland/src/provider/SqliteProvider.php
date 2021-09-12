<?php
declare(strict_types=1);

namespace FavoriteIslands\provider;

use FavoriteIslands\Loader;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected const INIT = "fai.init";
	protected const REGISTER = "fai.register";
	protected const REMOVE = "fai.remove";
	protected const SELECT_PLAYER = "fai.select.player";
	protected const SELECT_ID = "fai.select.id";

	protected DataConnector $database;
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	protected function asyncSelect(string $query, array $args){
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);
		return yield Await::ONCE;
	}

	public function init() : void{
		$this->database = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);

		$this->database->executeGeneric(self::INIT);
	}
}