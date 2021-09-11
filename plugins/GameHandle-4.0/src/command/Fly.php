<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Fly extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "fly");
		$this->setDescription("Fly command");
		$this->setPermission("gh.fly");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!($sender instanceof Player)){
			$sender->sendMessage("Use this command in-game !");
			return;
		}
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.fly.other")){
				$sender->sendMessage("You not have permission to enable fly other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args[0]);
			if(!isset($player)){
				$sender->sendMessage("Player not exist !");
				return;
			}
			if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isFly()){
				$player->setAllowFlight(true);
				$player->setFlying(true);
				$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setFly(true);
				$sender->sendMessage($player->getName() . "  Enabled Fly");
			}else{
				$player->setAllowFlight(false);
				$player->setFlying(false);
				$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setFly(false);
				$sender->sendMessage($player->getName() . " Disabled Fly");
			}
			return;
		}
		if(!$sender->hasPermission("gh.fly.use")){
			$sender->sendMessage("You not have permission to use this command");
			return;
		}
		if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->isFly()){
			$sender->setAllowFlight(true);
			$sender->setFlying(true);
			$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->setFly(true);
			$sender->sendMessage("Enabled Fly");
		}else{
			$sender->setAllowFlight(false);
			$sender->setFlying(false);
			$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->setFly(false);
			$sender->sendMessage("Disabled Fly");
		}
	}
}
