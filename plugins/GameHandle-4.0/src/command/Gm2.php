<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;

class Gm2 extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Game mode command");
		$this->setPermission("gh.gm2");
		$this->setAliases(["gma", "adventure"]);

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.gm2.other")){
				$sender->sendMessage("You don't have permission to set other player's game mode");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			$player->setGamemode(GameMode::ADVENTURE());
			$sender->sendMessage("Changed " . $player->getName() . "'s game mode to adventure !");
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please add player name !");
			return;
		}
		$sender->setGamemode(GameMode::ADVENTURE());
		$sender->sendMessage("Your game mode have changed to adventure !");
	}
}