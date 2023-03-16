<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\args;


use CortexPE\Commando\args\StringEnumArgument;
use NgLam2911\MineSweeper\area\AreaManager;
use pocketmine\command\CommandSender;

class SettingsArgs extends StringEnumArgument{

	public function __construct(bool $optional = false){
		parent::__construct("setting", $optional);
	}

	public function getEnumValues() : array{
		return [
			"autoFlag",
			"autoExplode",
			"recursiveExplode",
		];
	}


	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getTypeName() : string{
		return $this->name;
	}
}