<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class Freeze extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Freeze command");
		$this->setPermission("gh.freeze");

		$this->registerArgument(0, new PlayerArgs());
		$this->registerArgument(1, new IntegerArgument("seconds", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		if(!isset($player)){
			$sender->sendMessage("Player not exist !");
			return;
		}
		$time = $args["seconds"] ?? PHP_INT_MAX;
		$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setFreeze(true, $time);
		$sender->sendMessage("Frozen " . $player->getName() . " for " . $time . " seconds !");
		$player->sendMessage("You have been frozen for " . $time . " seconds");
	}
}
