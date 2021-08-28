<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\auction\Auction;
use AuctionHouse\auction\Bid;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MyBidsMenu extends BaseReadOnlyMenu{

	/** @var Bid[] */
	protected array $bids = [];
	/** @var Auction[] */
	protected array $auctions = [];

	protected function renderItems(): void{
		$inv = $this->getMenu()->getInventory();
		foreach($this->auctions as $auction){
			$inv->addItem($auction->getItem());
		}
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
		$slot = $transaction->getAction()->getSlot();
		if (isset($this->auctions[$slot])){
			$this->getMenu()->onClose($this->getPlayer());
			new AuctionMenu($this->getLoader(), $this->getPlayer(), $this->auctions[$slot]);
		}
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		// NOOP
	}

	protected function await(): void{
		Await::f2c(function(){
			$data = (array) yield $this->getLoader()->getProvider()->selectBidPlayer($this->getPlayer()->getName());
			$this->bids = Bid::fromArray($data);
			foreach($this->bids as $bid){
				$auction_data = (array) yield $this->getLoader()->getProvider()->selectAuctionID($bid->getAuctionId());
				$auction = Auction::fromData($auction_data);
				array_push($this->auctions, $auction);
			}
			$this->renderItems();
			$this->send();
		});
	}

	protected function getMenuName() : string{
		return "My Bids";
	}

	protected function getMenuType() : string{
		return InvMenuTypeIds::TYPE_CHEST;
	}
}