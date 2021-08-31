<?php
declare(strict_types=1);

namespace AuctionHouse\menu;
use AuctionHouse\auction\Auction;
use AuctionHouse\category\CategoryManager;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\inventory\Inventory;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class AuctionBrowserMenu extends BaseReadOnlyMenu{

	protected const ALL = 0;
	protected const NONE_EXPIRED_MODE = 1;
	protected const EXPIRED_MODE = 2;

	/** @var Auction[] */
	protected array $auctions;
	protected string $category = "";
	protected int $page = 0;
	protected int $showmode = 0;

	protected function renderItems(): void{
		$inv = $this->getMenu()->getInventory();
		$slot = 0;
		$pane = ItemFactory::getInstance()->get(ItemIds::STAINED_GLASS_PANE, 8);
		foreach(CategoryManager::getInstance()->getAllCategory() as $category){
			$item = $category->getMenuItem();
			if ($category->getId() == $this->category){
				$item->setLore(["§r§e>§fSelected§e<§r"]);
				$item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(100)));
			}
			$inv->setItem($slot, $item);
			$inv->setItem($slot + 1, $pane);
			$slot += 9; //TODO: Hacks
		}
		for($i = 47; $i <= 49; $i++){
			$inv->setItem($i, $pane);
		}
		$lore = ["  §r§fAll", "  §r§fAuction only", "  §r§fBin only"];
		switch($this->showmode){
			case self::ALL:
				$lore[0] = "§r§e> §fAll";
				break;
			case self::NONE_EXPIRED_MODE:
				$lore[1] = "§r§e> §fAuction Only";
				break;
			case self::EXPIRED_MODE:
				$lore[2] = "§r§e> §fBin Only";
		}
		$inv->setItem(51, ItemFactory::getInstance()->get(381)->setLore($lore)->setCustomName("§r§l§bShow")); //EYE OF ENDER
		$inv->setItem(52, VanillaItems::ARROW()->setCustomName("§r§fGo Back"));
		$inv->setItem(53, VanillaItems::ARROW()->setCustomName("§r§fNext Page"));
		$inv->setItem(50, VanillaItems::FEATHER()->setCustomName("§r§aRefresh"));

		for($i = 0; $i < 35; $i++){
			if (!isset($this->auctions[$i + $this->page * 35])) break;
			$auction = $this->auctions[$i + $this->page * 35];
			$item = $auction->getItem();
			$lore = $item->getLore();
			$add_lore = [
				"Seller: " . $auction->getPlayer(),
				"Price: " . $auction->getPrice(),
			];
			if ($auction->isExpired() > 0){
				array_push($add_lore, "Time Left: " . $auction->getTimeLeft() . " seconds");
			} else {
				array_push($add_lore, "Expired !");
			}
			$lore = array_merge($lore, $add_lore);
			$item->setLore($lore);
			$nbt = $item->getNamedTag();
			$nbt->setInt("AuctionPos" , $i + $this->page * 35);
			$item->setNamedTag($nbt);
			$inv->addItem($item);
		}
	}

	protected function onTransaction(DeterministicInvMenuTransaction $transaction): void{
		$slot = $transaction->getAction()->getSlot();
		if (in_array($slot, [0, 9, 18, 27, 36, 45])){
			$this->category = match($slot){
				0 => "Armor",
				9 => "Block",
				18 => "Food",
				27 => "Potion",
				36 => "Tool",
				45 => "",
			};
			$this->page = 0;
			$this->resetInventory();
			$this->await(false);
		}
		switch($slot){
			case 50:
				$this->resetInventory();
				$this->await(false);
				return;
			case 51:
				$this->showmode++;
				if ($this->showmode > 2){
					$this->showmode = 0;
				}
				$this->resetInventory();
				$this->await(false);
				return;
			case 52:
				if ($this->page > 1) $this->page--;
				$this->resetInventory();
				$this->await(false);
				return;
			case 53:
				$this->page++;
				$this->resetInventory();
				$this->await(false);
		}
		if ($transaction->getItemClicked()->getNamedTag()->getTag("AuctionPos") !== null){
			$value = (int)$transaction->getItemClicked()->getNamedTag()->getTag("AuctionPos")->getValue();
			new AuctionMenu($this->getLoader(), $this->getPlayer(), $this->auctions[$value]);
			$this->getMenu()->onClose($this->getPlayer());
		}
	}

	protected function onClose(Player $player, Inventory $inventory): void{
		//NOOP
	}

	protected function getMenuName(): string{
		return "Auction Browser";
	}

	protected function getMenuType(): string{
		return InvMenuTypeIds::TYPE_DOUBLE_CHEST;
	}

	protected function await(bool $sendmenu = true): void{
		Await::f2c(function() use ($sendmenu){
			$data = match ($this->showmode) {
				self::ALL => (array) yield $this->getLoader()->getProvider()->selectAuctionAll($this->category),
				self::NONE_EXPIRED_MODE => (array) yield $this->getLoader()->getProvider()->selectAuctionAllNoExpired($this->category),
				self::EXPIRED_MODE => (array) yield $this->getLoader()->getProvider()->selectAuctionAllExpired($this->category),
			};
			$this->auctions = Auction::fromArray($data);
			$this->renderItems();
			if ($sendmenu) $this->send();
		});
	}
}