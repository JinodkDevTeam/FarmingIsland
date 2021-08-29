<?php
declare(strict_types=1);

namespace AuctionHouse\menu;
use AuctionHouse\auction\Auction;
use AuctionHouse\category\CategoryManager;
use muqsit\invmenu\transaction\InvMenuTransaction;
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
		for($i = 47; $i <= 51; $i++){
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
		$inv->setItem(51, ItemFactory::getInstance()->get(381)->setLore($lore)->setCustomName("Show")); //EYE OF ENDER
		$inv->setItem(52, VanillaItems::ARROW()->setCustomName("Go Back"));
		$inv->setItem(53, VanillaItems::ARROW()->setCustomName("Next Page"));
	}

	protected function onTransaction(InvMenuTransaction $transaction): void{
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
			$this->renderItems();
		}
		if ($slot === 51){
			$this->showmode++;
			if ($this->showmode > 2){
				$this->showmode = 0;
			}
			$this->resetInventory();
			$this->renderItems();
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

	protected function await(bool $sendgui = true): void{
		Await::f2c(function() use ($sendgui){
			$data = (array) yield $this->getLoader()->getProvider()->selectAuctionAllNoExpired($this->category);
			$this->auctions = Auction::fromArray($data);
			$this->renderItems();
			if ($sendgui) $this->send();
		});
	}
}