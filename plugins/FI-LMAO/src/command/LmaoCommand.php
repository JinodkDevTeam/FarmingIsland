<?php
declare(strict_types=1);

namespace LMAO\command;

use CortexPE\Commando\args\BaseArgument;
use CortexPE\Commando\BaseCommand;
use LMAO\command\subcommand\HelpCommand;
use pocketmine\command\CommandSender;

class LmaoCommand extends BaseCommand{

	protected function prepare() : void{
		$this->setPermission("lmao.cmd");
		$this->registerSubCommand(new HelpCommand("help", "List troll feature."));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$sender->sendMessage("Use </lmao help> for more info");
	}
}