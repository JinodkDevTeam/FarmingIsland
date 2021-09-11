<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\task;

use Closure;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class DelayTask extends Task{
	public Core $core;
	public Closure $closure;
	public int $times;
	public Player $player;

	public function __construct(int $delaytick, Closure $closure, Core $core, Player $player){
		$core->getScheduler()->scheduleRepeatingTask($this, $delaytick);
		$this->core = $core;
		$this->closure = $closure;
		$this->times = 0;
		$this->player = $player;
	}

	public function getCore() : Core{
		return $this->core;
	}

	public function getClosure() : Closure{
		return $this->closure;
	}

	public function onRun() : void{
		// TODO: Implement onRun() method.
		if($this->times = 0){
			$this->times = 1;
			return;
		}
		$run = $this->closure;
		$run();
		$this->getHandler()->cancel();
	}
}
