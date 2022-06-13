<?php
declare(strict_types=1);

namespace Mail\ui;

use Mail\Loader;
use pocketmine\player\Player;

abstract class BaseUI{
	protected Loader $loader;
	protected string $username = "";

	public function __construct(Loader $loader, Player $player, string $username = ""){
		$this->loader = $loader;
		$this->execute($player);
	}

	public function execute(Player $player) : void{
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	protected function getUsername() : string{
		return $this->username;
	}
}