<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Feed extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Fees command");
		$this->setPermission("gh.feed");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.feed.other")){
				$sender->sendMessage("You not have permission to feed other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			$player->getHungerManager()->setFood(20);
			$sender->sendMessage($player->getName() . "have been fed");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game");
			return;
		}
		$sender->getHungerManager()->setFood(20);
		$sender->sendMessage("You have been fed !");
	}
}
