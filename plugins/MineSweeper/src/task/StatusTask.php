<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\task;

use NgLam2911\MineSweeper\area\Area;
use pocketmine\scheduler\Task;

class StatusTask extends Task{

	protected int $time = 0;

	public function __construct(
		protected Area $area
	){}

	public function onRun() : void{
		$this->time++;
		if ($this->area->isPlaying()){
			foreach($this->area->getPlayers() as $player){
				$player->getPlayer()->sendPopup($this->time2string() . " | " . $this->area->getBoard()->getMinesLeft() . " mines left");
				//TODO: Show mines left and time ???
			}
		}else{
			$this->getHandler()->cancel();
		}
	}

	public function time2string() : string{
		$min = floor($this->time / 60);
		$sec = $this->time % 60;
		return ($min < 10 ? "0" : "") . $min . ":" . ($sec < 10 ? "0" : "") . $sec;
	}
}