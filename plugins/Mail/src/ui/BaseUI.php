<?php
declare(strict_types=1);

namespace Mail\ui;

use Mail\Loader;
use pocketmine\player\Player;

abstract class BaseUI{
	protected Loader $loader;

	public function __construct(Loader $loader, Player $player){
		$this->loader = $loader;
		$this->execute($player);
	}

	public function execute(Player $player) : void{
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}
}