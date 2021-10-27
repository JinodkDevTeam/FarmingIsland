<?php
declare(strict_types=1);

namespace Backpack\provider;

use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class SqliteProvider{

	protected DataConnector $database;

	public function __construct(){

	}

	public function init() : void{
	}

	public function close() : void{
		if (isset($this->database)) $this->database->close();
	}
}