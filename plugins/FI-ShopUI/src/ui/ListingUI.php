<?php
declare(strict_types=1);

namespace ShopUI\ui;

use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use ShopUI\Category;
use ShopUI\ShopItem;

class ListingUI{

	protected Player $player;
	/** @var Category[]|ShopItem[] */
	protected array $list;
	protected string $title;

	public function __construct(Player $player, array $list, string $title){
		$this->player = $player;
		$this->list = $list;
		$this->title = $title;
	}

	public function send() : void{
		$form = new SimpleForm(function(Player $player, ?int $value){
			//TODO: Handle form response
		});
		$form->setTitle($this->title);
		$form->setContent("Your money: " . EconomyAPI::getInstance()->myMoney($this->player));
		$form->addButton("Back");
		foreach($this->list as $item){
			if ($item instanceof Category){
				$form->addButton($item->getName());
			}
			if ($item instanceof ShopItem){
				$form->addButton($item->getItem()->getName() . " - " . $item->getBuyPrice() . "$");
			}
		}
		$this->player->sendForm($form);
	}
}