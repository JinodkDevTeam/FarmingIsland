<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Fly extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Fly command");
		$this->setPermission("gh.fly");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.fly.other")){
				$sender->sendMessage("You not have permission to enable fly other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isFly()){
				$this->setFly($player, true);
				$sender->sendMessage("Enabled Fly for " . $player->getName());
			}else{
				$this->setFly($player, false);
				$sender->sendMessage("Disabled Fly for " . $player->getName());
			}
			return;
		}
		if(!($sender instanceof Player)){
			$sender->sendMessage("Use this command in-game !");
			return;
		}
		if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->isFly()){
			$this->setFly($sender, true);
			$sender->sendMessage("Enabled Fly");
		}else{
			$this->setFly($sender, false);
			$sender->sendMessage("Disabled Fly");
		}
	}

	protected function setFly(Player $player, bool $status) : bool{
		$player->setAllowFlight($status);
		$player->setFlying($status);
		$stat = $this->getCore()->getPlayerStatManager()->getPlayerStat($player);
		if (is_null($stat)){
			return false;
		}
		$stat->setFly($status);
		return true;
	}
}
