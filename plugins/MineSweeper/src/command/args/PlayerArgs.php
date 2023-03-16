<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\args;

use CortexPE\Commando\args\BaseArgument;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;

class PlayerArgs extends BaseArgument{

	public function getNetworkType() : int{
		return AvailableCommandsPacket::ARG_TYPE_TARGET;
	}

	public function canParse(string $testString, CommandSender $sender) : bool{
		return true;
	}

	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getTypeName() : string{
		return "player";
	}
}