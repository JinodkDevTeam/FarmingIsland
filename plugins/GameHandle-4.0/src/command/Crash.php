<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\task\RickRollTask;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use RuntimeException;

class Crash extends BaseCommand{

	protected function prepare() : void{
		$this->setDescription("Instantly crash the server");
		$this->setPermission("gh.crash");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if($sender instanceof ConsoleCommandSender){
			throw new RuntimeException("Crashed due to crash command.");
		}else{
			if($sender instanceof Player){
				//Rickroll them :>>>
				$this->getCore()->getScheduler()->scheduleRepeatingTask(new RickRollTask($sender), 60);
			}
		}
	}
}