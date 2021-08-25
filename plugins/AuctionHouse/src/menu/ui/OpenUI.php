<?php
declare(strict_types=1);

namespace AuctionHouse\menu\ui;

use AuctionHouse\menu\AuctionBrowserMenu;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class OpenUI extends BaseUI{

	protected function execute(Player $player): void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if (!isset($data)) return;
			switch($data){
				case 0:
					new AuctionBrowserMenu($this->getLoader(), $player);
					break;
				case 1:
					//TODO: Manage Bids
					break;
				case 2:
					//TODO: My Auctions
					break;
			}
		});
		$form->setTitle("Auction House");
		$form->addButton("Auction browser");
		$form->addButton("Manage Bids");
		$form->addButton("My Auctions");

		$player->sendForm($form);
	}
}