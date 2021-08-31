<?php
declare(strict_types=1);

namespace AuctionHouse\menu;


use AuctionHouse\auction\Auction;
use AuctionHouse\Loader;
use AuctionHouse\menu\ui\AuctionConfigureUI;
use JinodkDevTeam\utils\ItemUtils;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class CreateAuctionMenu extends BaseReadOnlyMenu{

	protected ?Auction $auction = null;

	protected float $price;
	protected int $time;

	public function __construct(Loader $loader, Player $player, ?Auction $auction = null){
		$this->auction = $auction;
		parent::__construct($loader, $player);
	}

	public function getAuction(): ?Auction{
		return $this->auction;
	}

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
		$this->price = 0;
		$this->time = 1;
		if ($this->getAuction() !== null){
			$inv->setItem(13, $this->getAuction()->getItem());
			$this->price = $this->getAuction()->getPrice();
			$this->time = $this->getAuction()->getAuctionTime();
		} else {
			$inv->setItem(13, ItemFactory::air());
		}
		$cfgItem = VanillaItems::GOLD_INGOT()->setCustomName("§r§fConfigure Auction")->setLore([
			"§r§fPrice: " . $this->price . " coin",
			"Time: " . $this->time . " hours"
		]);
		$createItem = VanillaItems::PAPER()->setCustomName("§r§aCreate Auction");

		$inv->setItem(29, $cfgItem);
		$inv->setItem(33, $createItem);
	}

	protected function onTransaction(DeterministicInvMenuTransaction $transaction): void{
		$slot = $transaction->getAction()->getSlot();
		if ($slot > 53){
			//Set Auction Item
			$this->getMenu()->getInventory()->setItem(13, $transaction->getItemClicked());
		}
		switch($slot){
			case 13:
				if ($this->getMenu()->getInventory()->getItem(13)->getId() !== ItemIds::AIR){
					$this->getPlayer()->getInventory()->addItem($this->getMenu()->getInventory()->getItem(13));
					$this->getMenu()->getInventory()->setItem(13, ItemFactory::air());
				}
				break;
			case 29:
				$this->getMenu()->onClose($this->getPlayer());
				new AuctionConfigureUI($this->getLoader(), $this->getPlayer(), new Auction(
					0,
					$this->getPlayer()->getName(),
					ItemUtils::toString($this->getMenu()->getInventory()->getItem(13)),
					"",
					$this->price,
					time(),
					$this->time,
					false,
					false
				));
				break;
			case 33:
				$this->getMenu()->onClose($this->getPlayer());
				$this->createAuction();
				break;
		}
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

	protected function createAuction(): void{
		//TODO: Create Auction...
	}
}