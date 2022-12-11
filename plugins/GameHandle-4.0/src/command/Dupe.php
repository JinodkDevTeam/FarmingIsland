<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\player\Player;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Dupe extends IngameCommand{

	protected function prepare() : void{
		$this->setDescription("Duplicate item in hand");
		$this->setPermission("gh.dupe");
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		$item = $player->getInventory()->getItemInHand();
		if($item->getId() == 0){
			$player->sendMessage(Lang::translate($player, TF::gh_cmd_dupe_fail_none()));
			return;
		}
		if($player->getInventory()->canAddItem($item)){
			$player->getInventory()->addItem($item);
			$player->sendMessage(Lang::translate($player, TF::gh_cmd_dupe_success()));
		}else{
			$player->sendMessage(Lang::translate($player, TF::gh_cmd_dupe_fail_invfull()));
		}
	}
}