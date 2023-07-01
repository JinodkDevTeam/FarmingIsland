<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils\db;

abstract class DataTable{

	protected abstract static function new() : self;

	protected abstract static function fromSQLData(array $data) : self;

	//I dont know that i should put this as async function or not...
	protected abstract static function toSQLData(self $data) : array;


}