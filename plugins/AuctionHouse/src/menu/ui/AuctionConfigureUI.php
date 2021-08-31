<?php
declare(strict_types=1);

namespace AuctionHouse\menu\ui;

use AuctionHouse\auction\Auction;
use AuctionHouse\Loader;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class AuctionConfigureUI extends BaseUI{

	protected Auction $auction;

	public function __construct(Loader $loader, Player $player, Auction $auction){
		$this->auction = $auction;
		parent::__construct($loader, $player);
	}

	protected function getAuction(): Auction{
		return $this->auction;
	}

	protected function execute(Player $player) : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			//TODO: Implement something.
		});

		$form->setTitle("Auction Configure");
		$form->addInput("Price (coin):", "123456789", (string)$this->getAuction()->getPrice());
		$form->addSlider("Auction Time (hours): ", 1, 24, 1, $this->getAuction()->getAuctionTime());

		$player->sendForm($form);
	}
}