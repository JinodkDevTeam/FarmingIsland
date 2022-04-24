<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\player\Player;

class NoTP extends IngameCommand{

	protected function prepare() : void{
		$this->setDescription("NoTP Mode command");
		$this->setPermission("gh.notp");
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		if($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isNoTP()){
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setNoTP(false);
			$player->sendMessage("NoTP disabled !");
		}else{
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setNoTP();
			$player->sendMessage("NoTP enabled !");
		}
	}
}
