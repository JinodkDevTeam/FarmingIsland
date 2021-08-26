<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\Loader;
use Generator;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

abstract class BaseReadOnlyMenu{

	protected InvMenu $menu;
	protected Loader $loader;
	protected array $data;

	public function __construct(Loader $loader, Player $player){
		$this->loader = $loader;
		Await::f2c(function() use ($player){
			$this->menu = InvMenu::create($this->getMenuType());
			$this->menu->setName($this->getMenuName());
			$this->setListeners();
			$this->data = yield $this->getAsyncData();
			$this->renderItems();
			$this->menu->send($player);
		});
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	protected function getMenuName(): string{
		return "";
	}

	protected function getData(): array{
		return $this->data;
	}

	protected function getMenuType(): string{
		return InvMenuTypeIds::TYPE_CHEST;
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

	protected abstract function getAsyncData(): Generator;

	protected abstract function renderItems(): void;

	protected abstract function onTransaction(InvMenuTransaction $transaction): void;

	protected abstract function onClose(Player $player, Inventory $inventory): void;

}