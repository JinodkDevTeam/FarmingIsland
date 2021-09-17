<?php
declare(strict_types=1);

namespace Bazaar\event;

use Bazaar\order\BuyOrder;
use Bazaar\order\SellOrder;
use pocketmine\player\Player;

class PlayerOrderEvent extends OrderEvent{
	protected Player $player;

	public function __construct(Player $player, SellOrder|BuyOrder $order){
		$this->player = $player;
		parent::__construct($order);
	}

	public function getPlayer() : Player{
		return $this->player;
	}
}