<?php
declare(strict_types=1);

namespace AutionHouse\menu\ui;

use AutionHouse\Loader;
use pocketmine\player\Player;

abstract class BaseUI{

	protected Loader $loader;

	protected final function getLoader(): Loader{
		return $this->loader;
	}

	public function __construct(Loader $loader, Player $player){
		$this->loader = $loader;
		$this->execute($player);
	}

	protected abstract function execute(Player $player): void;
}