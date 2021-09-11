<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Pos extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "pos");
		$this->setDescription("show position info");
		$this->setPermission("gh.pos");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!isset($args[0])){
			if(!$sender instanceof Player){
				$sender->sendMessage("/pos <player>");
				return;
			}
			$player = $sender;
		}else{
			if(!$sender->hasPermission("gh.pos.other")){
				$sender->sendMessage("You dont have permission to see position info of another player !");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args[0]);
		}
		if($player == null){
			$sender->sendMessage("Invalid player name !");
			return;
		}
		$this->showPos($sender, $player);
	}

	public function showPos(CommandSender $sender, Player $player){
		$pos = $player->getPosition();
		$sender->sendMessage($player->getName() . " position info:");
		$sender->sendMessage("X: " . $pos->getX());
		$sender->sendMessage("Y: " . $pos->getY());
		$sender->sendMessage("Z: " . $pos->getZ());
		$sender->sendMessage("World: " . $pos->getWorld()->getDisplayName());
	}
}
