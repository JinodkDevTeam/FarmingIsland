<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class Mute extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "mute");
		$this->setDescription("Mute command");
		$this->setPermission("gh.mute");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.mute")){
				$sender->sendMessage("You not have permission to use this command");
				return;
			}

			$player = Server::getInstance()->getPlayerByPrefix($args[0]);

			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			$time = PHP_INT_MAX;
			if(isset($args[1])){
				if(is_numeric($args[1])){
					$time = (int) $args[1];
				}else{
					$sender->sendMessage("Time must me numeric !");
					return;
				}
			}
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setMute(true, $time);
			$sender->sendMessage("Muted " . $player->getName() . " for " . $time . " seconds !");
			$player->sendMessage("You have been muted for " . $time . " seconds");
			return;
		}
		$sender->sendMessage("/mute <player> <time>");
	}
}
