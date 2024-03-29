<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command\args;

use CortexPE\Commando\args\StringEnumArgument;
use pocketmine\command\CommandSender;

class SellOptionsArgs extends StringEnumArgument{

	public function __construct(bool $optional = false){
		parent::__construct("SellOptions", $optional);
	}

	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getEnumValues() : array{
		return ["hand", "all", "undo"];
	}

	public function getTypeName() : string{
		return $this->name;
	}
}