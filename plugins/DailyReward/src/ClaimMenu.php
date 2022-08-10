<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward;

use pocketmine\player\Player;

class ClaimMenu {

	//1  2  3  4  5  6
	//7  8  9  10 11 12
	//13 14 15 16 17 18
	//19 20 21 22 23 24
	//25 26 27 28 29 30

	public function __construct(Player $player){
		$this->send($player);
	}

	public function send(Player $player){
		//TODO: Handle
	}
}