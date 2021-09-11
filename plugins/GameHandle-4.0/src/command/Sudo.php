<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Server;

class Sudo extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "sudo");
		$this->setDescription("Run command as console");
		$this->setPermission("gh.sudo");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.sudo")){
				$sender->sendMessage("You not have permission to use this command !");
				return;
			}
			$cmd = "";
			foreach($args as $arg){
				if($cmd == "") $cmd = $arg;else $cmd = $cmd . " " . $arg;
			}
			Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), $cmd);
		}else{
			$sender->sendMessage("/sudo <command>");
		}
	}
}
