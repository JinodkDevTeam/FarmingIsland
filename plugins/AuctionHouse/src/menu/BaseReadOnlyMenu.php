<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\Loader;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

abstract class BaseReadOnlyMenu{

	protected InvMenu $menu;
	protected Loader $loader;

	public function __contruct(Loader $loader, Player $player, string $type){
		$this->loader = $loader;
		$this->menu = InvMenu::create($type);
		$this->setListeners();
		$this->renderItems();
		$this->menu->send($player);
	}

	protected final function getMenu(): InvMenu{
		return $this->menu;
	}

	protected final function setListeners() {
		$this->getMenu()->setListener(InvMenu::readonly(function(InvMenuTransaction $transaction) {
			$this->onTransaction($transaction);
		}));
		$this->getMenu()->setInventoryCloseListener(function(Player $player, Inventory $inventory){
			$this->onClose($player, $inventory);
		});
	}

	protected abstract function renderItems(): void;

	protected abstract function onTransaction(InvMenuTransaction $transaction): void;

	protected abstract function onClose(Player $player, Inventory $inventory): void;

}