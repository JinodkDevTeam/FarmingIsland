<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use RuntimeException;

class Crash extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "crash");
		$this->setDescription("Instance crash the server");
		$this->setPermission("gh.crash");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if ($sender instanceof ConsoleCommandSender){
			throw new RuntimeException("Crashed due to crash command.");
		} else {
			$sender->sendMessage("No you ! <there is another way to use this command but you should find it for urself !>");
		}
	}
}