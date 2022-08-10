<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward\reward;

use pocketmine\player\Player;

interface Reward{
	public function getReward(Player $player) : void;
}