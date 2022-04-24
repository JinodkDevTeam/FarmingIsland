<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class TpAll extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("TpAll command");
		$this->setPermission("gh.tpall");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			foreach(Server::getInstance()->getOnlinePlayers() as $players){
				if ($player === $players){
					continue;
				}
				$players->teleport($player->getPosition());
			}
			$sender->sendMessage("All players have been teleported to " . $player->getName());
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("/tpall <player>");
			return;
		}
		$player = $sender;
		foreach(Server::getInstance()->getOnlinePlayers() as $players){
			if ($player === $players){
				continue;
			}
			$players->teleport($player->getPosition());
		}
		$sender->sendMessage("All player have been teleported to you");
	}
}