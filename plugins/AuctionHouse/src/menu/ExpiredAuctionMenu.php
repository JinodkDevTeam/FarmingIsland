<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

class ExpiredAuctionMenu extends BaseAuctionInfoMenu{

	protected function renderItems(): void{
		// TODO: Implement renderItems() method.
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
		// TODO: Implement onTransaction() method.
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		// NOOP
	}

	protected function getMenuName(): string{
		return "Auction Info";
	}

	protected function getMenuType() : string{
		return InvMenuTypeIds::TYPE_DOUBLE_CHEST;
	}
}