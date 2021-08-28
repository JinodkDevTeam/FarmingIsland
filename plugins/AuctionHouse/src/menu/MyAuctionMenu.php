<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\auction\Auction;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MyAuctionMenu extends BaseReadOnlyMenu{

	/** @var Auction[] */
	protected array $auctions = [];

	protected function renderItems(): void{
		$inv = $this->getMenu()->getInventory();
		foreach($this->auctions as $auction){
			$inv->addItem($auction->getItem());
		}
		$inv->setItem(26, VanillaItems::PAPER()->setCustomName("Create Auction"));
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
		$slot = $transaction->getAction()->getSlot();
		if (isset($this->auctions[$slot])){
			$this->getMenu()->onClose($this->getPlayer());
			new AuctionMenu($this->getLoader(), $this->getPlayer(), $this->auctions[$slot]);
			return;
		}
		if ($slot == 26){
			$this->getMenu()->onClose($this->getPlayer());
			new CreateAuctionMenu($this->getLoader(), $this->getPlayer());
		}
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		// NOOP
	}

	protected function await(): void{
		Await::f2c(function(){
			$data = (array) yield $this->getLoader()->getProvider()->selectAuctionPlayer($this->getPlayer()->getName());
			$this->auctions = Auction::fromArray($data);
			$this->renderItems();
			$this->send();
		});
	}

	protected function getMenuName() : string{
		return "My Auctions";
	}

	protected function getMenuType() : string{
		return InvMenuTypeIds::TYPE_CHEST;
	}
}