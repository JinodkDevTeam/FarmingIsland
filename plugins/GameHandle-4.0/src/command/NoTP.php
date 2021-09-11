<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class NoTP extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "notp");
		$this->setDescription("NoTP Mode command");
		$this->setPermission("gh.notp");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("Use ingame only !");
			return;
		}
		if($this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->isNoTP()){
			$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->setNoTP(false);
			$sender->sendMessage("NoTP disabled !");
		}else{
			$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->setNoTP();
			$sender->sendMessage("NoTP enabled !");
		}
	}
}
