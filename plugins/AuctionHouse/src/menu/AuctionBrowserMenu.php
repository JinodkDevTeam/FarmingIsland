<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\category\CategoryManager;
use Generator;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class AuctionBrowserMenu extends BaseReadOnlyMenu{

	protected function renderItems(): void{
		$data = $this->getData();
		$this->getMenu()->getInventory()->setItem(10, VanillaItems::STICK()->setCustomName("IT WORK !"));
	}

	protected function getAsyncData() : Generator{
		return yield $this->getLoader()->getProvider()->selectAuctionAll(CategoryManager::getInstance()->getCategory()->getId());
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
		// TODO: Implement onTransaction() method.
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		//NOOP
	}

	protected function getMenuName(): string{
		return "Auction Browser";
	}

	protected function getMenuType() : string{
		return InvMenuTypeIds::TYPE_DOUBLE_CHEST;
	}
}