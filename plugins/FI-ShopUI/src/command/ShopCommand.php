<?php
declare(strict_types=1);

namespace ShopUI\command;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class ShopCommand extends BaseCommand{

	protected function prepare() : void{
		$this->setAliases(["shopui", "shopitem", "cuahang"]);
		$this->setDescription("Open shop");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if ($sender instanceof Player){
			//TODO: Send UI
			return;
		}
		$sender->sendMessage("Please use this command as a player !");
	}
}