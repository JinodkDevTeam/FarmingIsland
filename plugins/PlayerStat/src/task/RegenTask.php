<?php
declare(strict_types=1);

namespace PlayerStat\task;

use PlayerStat\Loader;
use pocketmine\scheduler\Task;

class RegenTask extends Task{
	public function onRun() : void{
		$stats = Loader::getInstance()->getSessionManager()->getAll();
		foreach($stats as $stat){
			$stat->regenerateHealth();
			$stat->regenerateMana();
			$stat->show();
		}
	}
}