<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class PlayerInfo extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "playerinfo");
		$this->setDescription("Show player infomation");
		$this->setPermission("gh.playerinfo");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!isset($args[0])){
			if(!$sender instanceof Player){
				$sender->sendMessage("/playerinfo <player>");
				return;
			}
			$player = $sender;
		}else{
			if(!$sender->hasPermission("gh.playerinfo.other")){
				$sender->sendMessage("You dont have permission to see another player info !");
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
		$sender->sendMessage($player->getDisplayName() . " info:");
		$sender->sendMessage("X: " . $pos->getX());
		$sender->sendMessage("Y: " . $pos->getY());
		$sender->sendMessage("Z: " . $pos->getZ());
		$sender->sendMessage("World: " . $pos->getWorld()->getDisplayName());
		$sender->sendMessage("Realname: " . $player->getName());
		$sender->sendMessage("IP: " . $player->getNetworkSession()->getIp());
		$sender->sendMessage("Port: " . $player->getNetworkSession()->getPort());
		$sender->sendMessage("Ping: " . $player->getNetworkSession()->getPing() . " ms");
		$sender->sendMessage("Locate: " . $player->getPlayerInfo()->getLocale());
		$player->sendMessage("UUID: " . $player->getPlayerInfo()->getUuid()->toString());
		$sender->sendMessage("XUID: " . $player->getXuid());
	}
}