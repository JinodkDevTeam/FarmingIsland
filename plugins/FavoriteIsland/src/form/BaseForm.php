<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FavoriteIslands\Loader;
use pocketmine\player\Player;

abstract class BaseForm{

	protected Loader $loader;
	protected Player $player;
	protected array $args;

	protected function getLoader() : Loader{
		return $this->loader;
	}

	protected function getPlayer() : Player{
		return $this->player;
	}

	protected function getArgs() : array{
		return $this->args;
	}

	public function __construct(Loader $loader, Player $player, array $args = [], bool $execute = true){
		$this->loader = $loader;
		$this->player = $player;
		$this->args = $args;
		if ($execute) $this->execute();
	}

	public abstract function execute() : void;
}