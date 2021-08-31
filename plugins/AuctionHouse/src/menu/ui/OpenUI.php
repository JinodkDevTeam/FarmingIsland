<?php
declare(strict_types=1);

namespace AuctionHouse\menu\ui;

use AuctionHouse\auction\Auction;
use AuctionHouse\menu\AuctionBrowserMenu;
use AuctionHouse\menu\MyAuctionMenu;
use AuctionHouse\menu\MyBidsMenu;
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
					new MyBidsMenu($this->getLoader(), $player);
					break;
				case 2:
					new MyAuctionMenu($this->getLoader(), $player);
					break;
				case 3:
					new AuctionConfigureUI($this->getLoader(), $player, Auction::getTestAuction());
			}
		});
		$form->setTitle("Auction House");
		$form->addButton("Auction browser");
		$form->addButton("Manage Bids");
		$form->addButton("My Auctions");
		$form->addButton("Test AuctionConfigure");

		$player->sendForm($form);
	}
}