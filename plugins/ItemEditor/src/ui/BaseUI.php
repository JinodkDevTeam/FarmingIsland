<?php
declare(strict_types=1);

namespace ItemEditor\ui;

use pocketmine\player\Player;

abstract class BaseUI{

	public function __construct(Player $player){
		$this->execute($player);
	}
	protected abstract function execute(Player $player);
}