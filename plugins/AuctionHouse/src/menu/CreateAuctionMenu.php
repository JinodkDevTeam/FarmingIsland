<?php
declare(strict_types=1);

namespace AuctionHouse\menu;


use muqsit\invmenu\transaction\InvMenuTransaction;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

class CreateAuctionMenu extends BaseReadOnlyMenu{

	protected function renderItems() : void{
		// TODO: Implement renderItems() method.
	}

	protected function onTransaction(InvMenuTransaction $transaction) : void{
		// TODO: Implement onTransaction() method.
	}

	protected function onClose(Player $player, Inventory $inventory) : void{
		// TODO: Implement onClose() method.
	}

	protected function getMenuName() : string{
		return "Create Auction";
	}
}