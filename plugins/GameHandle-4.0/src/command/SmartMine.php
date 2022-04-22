<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class SmartMine extends LegacyBaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "smartmine");
		$this->setDescription("SmartMine Manager");
		$this->setPermission("gh.sudo");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.smartmine")){
				$sender->sendMessage("You not have permission to use this command !");
				return;
			}
			$sm = Server::getInstance()->getPluginManager()->getPlugin("FI-SmartMine");
			if($sm == null){
				$sender->sendMessage("Missed SmartMine module, please install it first then use this command again!");
				return;
			}
			if($args[0] == "on"){
				$sm->is_edit = false;
				$sender->sendMessage("[SmartMine] Edit mode is disabled");
				return;
			}
			if($args[0] == "off"){
				$sm->is_edit = true;
				$sender->sendMessage("[SmartMine] Edit mode is enabled");
			}else{
				$sender->sendMessage("/smartmine <on|off>");
			}
		}else{
			$sender->sendMessage("/smartmine <on|off>");
		}
	}
}
