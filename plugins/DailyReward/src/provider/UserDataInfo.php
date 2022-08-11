<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward\provider;

use pocketmine\player\Player;

class UserDataInfo{

	protected Player $player;
	protected int $streak;
	protected int $lastClaimtime;

	public function __construct(Player $player, int $streak, int $claimtime){
		$this->player = $player;
		$this->streak = $streak;
		$this->lastClaimtime = $claimtime;
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getStreak() : int{
		return $this->streak;
	}

	public function getLastClaimtime() : int{
		return $this->lastClaimtime;
	}

	public function setStreak(int $streak) : void{
		$this->streak = $streak;
	}

	public function setLastClaimtime(int $lastClaimtime) : void{
		$this->lastClaimtime = $lastClaimtime;
	}
}