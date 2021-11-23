<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use RuntimeException;

class Crash extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "crash");
		$this->setDescription("Instance crash the server");
		$this->setPermission("gh.crash");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		throw new RuntimeException("Crashed due to crash command.");
	}
}