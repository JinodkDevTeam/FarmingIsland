<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\player\Player;

class Dupe extends IngameCommand{

	protected function prepare() : void{
		$this->setDescription("Duplicate item in hand");
		$this->setPermission("gh.dupe");
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		$item = $player->getInventory()->getItemInHand();
		if($item->getId() == 0){
			$player->sendMessage("Why you want to duplicate nothing ?");
			return;
		}
		if($player->getInventory()->canAddItem($item)){
			$player->getInventory()->addItem($item);
			$player->sendMessage("Item duplicate successfully !");
		}else{
			$player->sendMessage("Failed to duplicate this item, maybe your inventory is full.");
		}
	}
}