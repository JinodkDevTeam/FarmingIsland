<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command\args;

use CortexPE\Commando\args\StringEnumArgument;
use CustomAddons\item\CustomItems;
use pocketmine\command\CommandSender;

class CustomItemIDArgs extends StringEnumArgument{

	public function __construct(bool $optional = false){
		parent::__construct("ItemID", $optional);
	}

	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getEnumValues() : array{
		return array_map(fn($value) => strtolower($value), array_keys(CustomItems::getAll()));
	}

	public function getTypeName() : string{
		return $this->name;
	}
}