<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward\reward;

use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;

class MoneyReward implements Reward{

	protected float $amount;

	public function __construct(float $amount){
		$this->amount = $amount;
	}

	public function getReward(Player $player) : void{
		EconomyAPI::getInstance()->addMoney($player, $this->amount);
	}
}