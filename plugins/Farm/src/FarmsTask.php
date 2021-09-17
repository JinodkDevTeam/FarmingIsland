<?php
declare(strict_types=1);

namespace Farms;

use pocketmine\scheduler\Task;

class FarmsTask extends Task{
	public Farms $plugin;

	public function __construct(Farms $plugin){
		$this->plugin = $plugin;
	}

	public function onRun() : void{
		$this->getPlugin()->tick();
	}

	public function getPlugin() : Farms{
		return $this->plugin;
	}
}