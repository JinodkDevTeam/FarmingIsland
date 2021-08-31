<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\Loader;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

abstract class BaseReadOnlyMenu{

	protected InvMenu $menu;
	protected Loader $loader;
	protected Player $player;

	public function __construct(Loader $loader, Player $player){
		$this->loader = $loader;
		$this->player = $player;
		$this->menu = InvMenu::create($this->getMenuType());
		$this->menu->setName($this->getMenuName());
		$this->setListeners();
		$this->await();
	}

	protected function send(){
		$this->menu->send($this->player);
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	protected function getPlayer(): Player{
		return $this->player;
	}

	protected function getMenuName(): string{
		return "";
	}

	protected function getMenuType(): string{
		return InvMenuTypeIds::TYPE_CHEST;
	}

	protected final function getMenu(): InvMenu{
		return $this->menu;
	}

	protected final function setListeners() {
		$this->getMenu()->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {
			$this->onTransaction($transaction);
		}));
		$this->getMenu()->setInventoryCloseListener(function(Player $player, Inventory $inventory){
			$this->onClose($player, $inventory);
		});
	}

	protected final function resetInventory(): void{
		$this->getMenu()->getInventory()->clearAll();
	}

	protected abstract function await(): void;

	protected abstract function renderItems(): void;

	protected abstract function onTransaction(DeterministicInvMenuTransaction $transaction): void;

	protected abstract function onClose(Player $player, Inventory $inventory): void;

}