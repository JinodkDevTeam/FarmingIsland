<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use Exception;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class UnFreeze extends BaseCommand{


	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("UnFreeze command");
		$this->setPermission("gh.unfreeze");

		$this->registerArgument(0, new PlayerArgs());
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			try{
				$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setFreeze(false);
			}catch(Exception){
				$sender->sendMessage("PlayerStat Data Error !");
				return;
			}
			$sender->sendMessage("Unfreeze " . $player->getName() . " !");
			$player->sendMessage("You have been unfreeze !");
			return;
		}
		$sender->sendMessage("/unfreeze <player>");
	}
}
