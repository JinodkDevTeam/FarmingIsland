<?php
declare(strict_types=1);

namespace Backpack\ui;

use Backpack\Loader;
use pocketmine\player\Player;

abstract class BaseUI{

	protected Loader $loader;
	protected Player $player;

	public function __construct(Loader $loader, Player $player){
		$this->loader = $loader;
		$this->player = $player;
		$this->execute($player);
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	protected function getPlayer() : Player{
		return $this->player;
	}

	protected abstract function execute(Player $player) : void;
}