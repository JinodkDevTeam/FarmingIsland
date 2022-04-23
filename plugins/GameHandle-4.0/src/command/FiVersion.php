<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;

class FiVersion extends BaseCommand{

	protected function prepare() : void{
		$this->setDescription("FarmingIsland Version");
		$this->setPermission("gh.fiver");
		$this->setAliases(["fiver", "fi-ver"]);
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$sender->sendMessage("Server Version: " . Core::VERSION . " [" . Core::CODE_NAME . "]");
	}
}