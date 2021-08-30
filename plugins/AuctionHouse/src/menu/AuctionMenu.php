<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\auction\Auction;
use AuctionHouse\auction\Bid;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class AuctionMenu extends BaseAuctionInfoMenu{

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
		$addbid = VanillaItems::POTATO()->setCustomName("Add Bid");
		$listbid = VanillaItems::PAPER()->setCustomName("List bids");
		//TODO: Lore info for this items
		$inv->setItem(13, $this->getAuction()->getItem());
		$inv->setItem(29, $addbid);
		$inv->setItem(33, $listbid);
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
		// TODO: Implement onTransaction() method.
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		//NOOP
	}

	protected function getMenuName(): string{
		return "Auction Info";
	}

	protected function getMenuType(): string{
		return InvMenuTypeIds::TYPE_DOUBLE_CHEST;
	}

	protected function await($sendmenu = true): void{
		Await::f2c(function() use ($sendmenu){
			//RE-FLETCH AUCTION
			$data = yield $this->getLoader()->getProvider()->selectAuctionID($this->getAuction()->getId());
			if (empty($data)){
				$this->getPlayer()->sendMessage("Something went wrong in this auction, please reopen Auction Browser !");
				return;
			}
			$this->auction = Auction::fromData($data[0]);

			$this->renderItems();
			if ($sendmenu) $this->send();
		});
	}
}