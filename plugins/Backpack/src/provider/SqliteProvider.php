<?php
declare(strict_types=1);

namespace Backpack\provider;

use Backpack\Loader;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class SqliteProvider{

	protected DataConnector $database;
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	public function init() : void{
	}

	public function close() : void{
		if (isset($this->database)) $this->database->close();
	}
}