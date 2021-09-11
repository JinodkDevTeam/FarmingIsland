<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;

class Gm0 extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "gm0");
		$this->setDescription("Game mode command");
		$this->setPermission("gh.gm0");
		$this->setAliases(["gms"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.gm0.other")){
				$sender->sendMessage("You not have permission to set game mode other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args[0]);
			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			$player->setGamemode(GameMode::SURVIVAL());
			$sender->sendMessage($player->getName() . " changed game mode to survival");
			return;
		}
		if(!$sender->hasPermission("gh.gm0.use")){
			$sender->sendMessage("You not have permission to use this command");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please add player arg !");
			return;
		}
		$sender->setGamemode(GameMode::SURVIVAL());
		$sender->sendMessage("Your game mode have changed to survival !");
	}
}