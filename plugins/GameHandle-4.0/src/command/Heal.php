<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Heal extends BaseCommand{

	protected function prepare() : void{
		$this->setDescription("Heal command");
		$this->setPermission("gh.heal");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.heal.other")){
				$sender->sendMessage("You don't have permission to heal other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			$player->setHealth(20);
			$sender->sendMessage($player->getName() . "have been healed");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game");
			return;
		}
		$sender->setHealth(20);
		$sender->sendMessage("You have been healed !");
	}
}
