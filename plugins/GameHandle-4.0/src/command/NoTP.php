<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\player\Player;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class NoTP extends IngameCommand{

	protected function prepare() : void{
		$this->setDescription("NoTP Mode command");
		$this->setPermission("gh.notp");
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		if($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isNoTP()){
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setNoTP(false);
			$player->sendMessage(Lang::translate($player, TF::gh_cmd_notp_disable()));
		}else{
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setNoTP();
			$player->sendMessage(Lang::translate($player, TF::gh_cmd_notp_enable()));
		}
	}
}
