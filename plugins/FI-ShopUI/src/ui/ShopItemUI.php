<?php
declare(strict_types=1);

namespace ShopUI\ui;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use ShopUI\ShopItem;

class ShopItemUI{

	protected Player $player;
	protected ShopItem $item;

	protected function __construct(Player $player, ShopItem $item){
		$this->player = $player;
		$this->item = $item;
	}

	protected function send() : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			//TODO: Handle form response
		});
		$form->setTitle($this->item->getItem()->getName());
		$form->addLabel("Buy: " . $this->item->getBuyPrice() . " coin");
		$form->addLabel("Sell: " . $this->item->getSellPrice() . " coin");
		$form->addToggle("Buy/Sell", true, "Buy/SELLLLL");
	}
}