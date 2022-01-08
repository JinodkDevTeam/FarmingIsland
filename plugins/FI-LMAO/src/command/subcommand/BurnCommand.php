<?php
declare(strict_types=1);

namespace LMAO\command\subcommand;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\BaseSubCommand;
use LMAO\command\args\PlayerArgument;
use pocketmine\command\CommandSender;

class BurnCommand extends BaseSubCommand{

	protected function prepare() : void{
		$this->setPermission("lmao.burn");
		$this->registerArgument(0, new PlayerArgument());
		$this->registerArgument(1, new IntegerArgument("time"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		// TODO: Implement onRun() method.
	}
}
