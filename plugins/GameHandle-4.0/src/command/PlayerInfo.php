<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class PlayerInfo extends BaseCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Show player infomation");
		$this->setPermission("gh.playerinfo");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!isset($args["player"])){
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
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		}
		if(is_null($player)){
			$sender->sendMessage("Invalid player name !");
			return;
		}
		$this->showInfo($sender, $player);
	}

	public function showInfo(CommandSender $sender, Player $player){
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
		$sender->sendMessage("UUID: " . $player->getPlayerInfo()->getUuid()->toString());
		$sender->sendMessage("XUID: " . $player->getXuid());
	}
}