<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\auction\Auction;
use AuctionHouse\auction\Bid;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class AuctionMenu extends BaseAuctionInfoMenu{
	/** @var Bid[] */
	protected array $bids;
	protected ?Bid $player_bid = null;

	protected ?Item $addBid = null;
	protected ?Item $listBid = null;
	protected ?Item $claimBid = null;
	protected ?Item $claimItem = null;
	protected ?Item $buynow = null;
	protected ?Item $removeBid = null;

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
		$inv->setItem(13, $this->getAuction()->getItem());

		if (!$this->getAuction()->isExpired()){
			$this->addBid = VanillaItems::POTATO()->setCustomName("Add Bid");
			$this->listBid = VanillaItems::PAPER()->setCustomName("List bids");
			$inv->setItem(29, $this->addbid);
			$inv->setItem(33, $this->listbid);
		} else {
			if ($this->getAuction()->isHaveBid()){
				//SELLER
				if ($this->getAuction()->isSeller($this->getPlayer())){
					$this->claimBid = VanillaItems::PAPER();

				}
			}
		}
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
			$data = yield $this->getLoader()->getProvider()->selectBidId($this->getAuction()->getId());
			$this->bids = Bid::fromArray($data);
			$data = yield $this->getLoader()->getProvider()->selectBidPandI($this->player->getName(), $this->getAuction()->getId());
			if (!empty($data)) $this->player_bid = Bid::fromData($data[0]);
			$this->renderItems();
			if ($sendmenu) $this->send();
		});
	}
}