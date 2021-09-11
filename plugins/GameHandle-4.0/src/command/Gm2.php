<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;

class Gm2 extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "gm2");
		$this->setDescription("Game mode command");
		$this->setPermission("gh.gm2");
		$this->setAliases(["gma"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.gm2.other")){
				$sender->sendMessage("You not have permission to set game mode other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args[0]);
			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			$player->setGamemode(GameMode::ADVENTURE());
			$sender->sendMessage($player->getName() . " changed game mode to adventure");
			return;
		}
		if(!$sender->hasPermission("gh.gm2.use")){
			$sender->sendMessage("You not have permission to use this command");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please add player arg !");
			return;
		}
		$sender->setGamemode(GameMode::ADVENTURE());
		$sender->sendMessage("Your game mode have changed to adventure !");
	}
}


