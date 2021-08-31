<?php
declare(strict_types=1);

namespace AuctionHouse\menu;


use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class CreateAuctionMenu extends BaseReadOnlyMenu{


	protected function renderItems(): void{
		$inv = $this->getMenu()->getInventory();
		$pane = ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 8);
		$pane2 = ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 4);
		for($i = 0; $i <= 53; $i++){
			$inv->setItem($i, $pane);
		}
		for($i = 0; $i <= 5; $i++){
			$inv->setItem($i * 9, $pane2);
			$inv->setItem(($i * 9) + 8, $pane2);
		}
	}

	protected function onTransaction(DeterministicInvMenuTransaction $transaction): void{
		// TODO: Implement onTransaction() method.
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		// TODO: Implement onClose() method.
	}

	protected function getMenuName(): string{
		return "Create Auction";
	}

	protected function getMenuType() : string{
		return InvMenuTypeIds::TYPE_DOUBLE_CHEST;
	}

	protected function await(): void{
		$this->renderItems();
		$this->send();
	}
}