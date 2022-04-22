<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command\args;

use CortexPE\Commando\args\StringEnumArgument;
use CustomItems\item\utils\StringToCustomItemParser;
use pocketmine\command\CommandSender;

class CustomItemIDArgs extends StringEnumArgument{

	public function __construct(bool $optional = false){
		parent::__construct("ItemID", $optional);
	}

	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getEnumValues() : array{
		return StringToCustomItemParser::getInstance()->getKnownAliases();
	}

	public function getTypeName() : string{
		return $this->name;
	}
}