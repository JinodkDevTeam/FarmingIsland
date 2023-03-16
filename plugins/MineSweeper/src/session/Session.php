<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\session;

use NgLam2911\MineSweeper\area\Area;
use pocketmine\player\Player;

class Session{

	/** @var Area[] */
	protected array $playingAreas = [];

	public function __construct(
		protected Player $player,
		protected bool $isAutoFlag = false,
		protected bool $isAutoExplode = false,
		protected bool $isRecursiveExplode = false,
	){}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getName() : string{
		return $this->player->getName();
	}

	public function isAutoFlag() : bool{
		return $this->isAutoFlag;
	}

	public function setAutoFlag(bool $autoFlag) : void{
		$this->isAutoFlag = $autoFlag;
	}

	public function isAutoExplode() : bool{
		return $this->isAutoExplode;
	}

	public function setAutoExplode(bool $autoExplode) : void{
		$this->isAutoExplode = $autoExplode;
	}

	public function isRecursiveExplode() : bool{
		return $this->isRecursiveExplode;
	}

	public function setRecursiveExplode(bool $recursiveExplode) : void{
		$this->isRecursiveExplode = $recursiveExplode;
	}

	public function addPlayingArea(Area $area) : void{
		$this->playingAreas[$area->getName()] = $area;
	}

	public function removePlayingArea(Area $area) : void{
		unset($this->playingAreas[$area->getName()]);
	}

	public function getPlayingAreas() : array{
		return $this->playingAreas;
	}
}