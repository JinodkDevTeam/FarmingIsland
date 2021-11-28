<?php
declare(strict_types=1);

namespace YassenTrick\SizePlayer;

use pocketmine\plugin\PluginBase;

class SizePlayer extends PluginBase{

	public const MAX_SIZE = 10; // Prevent lags when go over 10, its was 15 but got lag.
	public const MIN_SIZE = 0.05; //Prevent server frezee when set size too low.

	public function onEnable() : void{
		$this->getServer()->getCommandMap()->register("sizeplayer", new SizePlayerCommand($this));
	}
}
