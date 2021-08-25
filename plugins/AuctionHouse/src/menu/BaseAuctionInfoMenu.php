<?php
declare(strict_types=1);

namespace AuctionHouse\menu;

use AuctionHouse\auction\Auction;
use AuctionHouse\Loader;
use pocketmine\player\Player;

abstract class BaseAuctionInfoMenu extends BaseReadOnlyMenu{

	protected Auction $auction;

	public function __construct(Loader $loader, Player $player, Auction $auction){
		$this->auction = $auction;
		parent::__construct($loader, $player);
	}

	protected function getAuction(): Auction{
		return $this->auction;
	}
}