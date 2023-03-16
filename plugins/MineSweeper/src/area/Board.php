<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area;

use InvalidArgumentException;
use pocketmine\math\Vector2;

class Board{

	/** @var TileInfo[][] */
	public array $tiles = []; // I hate PM Matrix
	protected ?Vector2 $startPos = null;
	protected bool $gameOver = false;
	protected bool $gameWin = false;
	protected int $flags = 0;

	public function __construct(
		protected int $width,
		protected int $height,
		protected int $mines,
		protected bool $safeArea = true
	){
		if ($this->width < 1 || $this->height < 1){
			throw new InvalidArgumentException("Width and height must be greater than 0");
		}
		if ($this->mines < 1){
			throw new InvalidArgumentException("Mines must be greater than 0");
		}
		if ($this->mines > ($this->width * $this->height - 1)){
			throw new InvalidArgumentException("Mines must be less than or equal to " . ($this->width * $this->height - 1));
		}
		if (($this->mines < ($this->width * $this->height - 9)) && $this->safeArea){
			$this->safeArea = false;
		}
		//INIT
		for($i = 0; $i < $this->width; $i++){
			for($j = 0; $j < $this->height; $j++){
				$this->tiles[$i][$j] = TileInfo::UNOPENED();
			}
		}
	}

	public function getWidth() : int{
		return $this->width;
	}

	public function getHeight() : int{
		return $this->height;
	}

	public function getMines() : int{
		return $this->mines;
	}

	public function hasSafeArea() : bool{
		return $this->safeArea;
	}

	public function getTile(Vector2 $pos) : ?TileInfo{
		return $this->tiles[$pos->x][$pos->y] ?? null;
	}

	public function setTile(Vector2 $pos, TileInfo $tile) : void{
		$this->tiles[$pos->x][$pos->y] = $tile;
	}

	public function isGameOver() : bool{
		return $this->gameOver;
	}

	public function isWinned() : bool{
		return $this->gameWin;
	}

	public function getStartPos() : ?Vector2{
		return $this->startPos;
	}

	public function generateMines() : void{
		if ($this->startPos === null){
			return;
		}
		//Refesh
		for($i = 0; $i < $this->width; $i++){
			for($j = 0; $j < $this->height; $j++){
				$this->tiles[$i][$j] = TileInfo::UNOPENED();
			}
		}
		if ($this->hasSafeArea()){
			for ($i = $this->startPos->getX() - 1; $i <= $this->startPos->getX() + 1; $i++){
				for ($j = $this->startPos->getY() - 1; $j <= $this->startPos->getY() + 1; $j++){
					$this->setTile(new Vector2($i, $j), TileInfo::SAFE_TILE());
				}
			}
		}

		$placedMines = 0;
		while ($placedMines < $this->getMines()){
			$x = mt_rand(0, $this->width - 1);
			$y = mt_rand(0, $this->height - 1);
			if ($this->getTile(new Vector2($x, $y)) === TileInfo::UNOPENED()){
				$this->setTile(new Vector2($x, $y), TileInfo::MINE());
				$placedMines++;
			}
		}

		for ($i = 0; $i < $this->width; $i++){
			for ($j = 0; $j < $this->height; $j++){
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::SAFE_TILE()){
					$this->setTile(new Vector2($i, $j), TileInfo::UNOPENED());
				}
			}
		}
	}

	public function explodeUnopened(Vector2 $pos, bool $isRecursiveExplode = false) : void{
		if ($this->startPos === null){
			$this->startPos = $pos;
			$this->generateMines();
		}
		if ($this->getTile($pos) === TileInfo::MINE()){
			$this->setTile($pos, TileInfo::MINE_EXPLODED());
			$this->gameOver = true;
			return;
		}
		//Scan around tiles (except for the tile at $pos)
		$mines = 0;
		$questionMine = 0;
		$flags = 0;
		$wrongFlags = 0;
		for ($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
			for ($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
				if ($i === $pos->getX() && $j === $pos->getY()){
					continue;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::MINE()){
					$mines++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::QUESTION_MINE()){
					$questionMine++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::FLAG()){
					$flags++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::WRONG_FLAG()){ //Include wrong flag !!! haha
					$wrongFlags++;
				}
			}
		}
		$realMines = $mines + $questionMine + $flags;
		$this->setTile($pos, TileInfo::fromName($realMines));
		//If the tile is 0, scan around tiles (except for the tile at $pos)
		if (($realMines) === 0){
			for ($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
				for ($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
					if ($i === $pos->getX() && $j === $pos->getY()){
						continue;
					}
					if ($this->getTile(new Vector2($i, $j)) === TileInfo::UNOPENED()){
						$this->explodeUnopened(new Vector2($i, $j));
					}
				}
			}
		}elseif($isRecursiveExplode){
			if (($realMines - ($flags + $wrongFlags)) === 0){
				for ($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
					for ($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
						if ($i === $pos->getX() && $j === $pos->getY()){
							continue;
						}
						if ($this->getTile(new Vector2($i, $j)) === TileInfo::UNOPENED() or $this->getTile(new Vector2($i, $j)) === TileInfo::MINE()){
							$this->explodeUnopened(new Vector2($i, $j), true);
						}
						if ($this->isGameOver()){
							return;
						}
					}
				}
			}
		}
	}

	public function explodeNumber(Vector2 $pos, bool $isAutoExplode = false, bool $isRecursiveExplode = false) : void{
		if ($isAutoExplode === false){
			return;
		}
		//Scan around tiles (except for the tile at $pos)
		$mines = 0;
		$questionMine = 0;
		$flags = 0;
		$wrongFlags = 0;
		for ($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
			for ($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
				if ($i === $pos->getX() && $j === $pos->getY()){
					continue;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::MINE()){
					$mines++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::QUESTION_MINE()){
					$questionMine++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::FLAG()){
					$flags++;
				}
				if ($this->getTile(new Vector2($i, $j)) === TileInfo::WRONG_FLAG()){ //Include wrong flag !!! haha
					$wrongFlags++;
				}
			}
		}
		$realMines = $mines + $questionMine + $flags;
		if (($realMines - ($flags + $wrongFlags)) === 0){
			for ($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
				for ($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
					if ($i === $pos->getX() && $j === $pos->getY()){
						continue;
					}
					if ($this->getTile(new Vector2($i, $j)) === TileInfo::UNOPENED() or $this->getTile(new Vector2($i, $j)) === TileInfo::MINE()){
						$this->explodeUnopened(new Vector2($i, $j), $isRecursiveExplode);
					}
					if ($this->isGameOver()){
						return;
					}
				}
			}
		}
	}

	public function autoFlag(Vector2 $pos) : void{
		$tile = $this->getTile($pos);
		if ($tile->isNumber()){
			for($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
				for($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
					if ($i === $pos->getX() && $j === $pos->getY()){
						continue;
					}
					$currentTile = $this->getTile(new Vector2($i, $j));
					if ($currentTile === TileInfo::UNOPENED() || $currentTile === TileInfo::WRONG_FLAG() || $currentTile === TileInfo::QUESTION()){
						return;
					}
				}
			}
			for($i = $pos->getX() - 1; $i <= $pos->getX() + 1; $i++){
				for($j = $pos->getY() - 1; $j <= $pos->getY() + 1; $j++){
					if ($i === $pos->getX() && $j === $pos->getY()){
						continue;
					}
					$currentTile = $this->getTile(new Vector2($i, $j));
					if ($currentTile === TileInfo::MINE() || $currentTile === TileInfo::QUESTION_MINE()){
						$this->setTile(new Vector2($i, $j), TileInfo::FLAG());
						$this->flags++;
					}
				}
			}
		}
	}

	public function interact(Vector2 $pos, bool $flag = false, bool $isAutoFlag = false, bool $isAutoExplode = false, $isRecursiveExplode = false) : void{
		$tile = $this->getTile($pos);
		switch($tile){
			case TileInfo::UNOPENED():
				if ($flag){
					$this->setTile($pos, TileInfo::WRONG_FLAG());
					$this->flags++;
				}else{
					$this->explodeUnopened($pos, $isRecursiveExplode);
				}
				break;
			case TileInfo::MINE():
				if ($flag){
					$this->setTile($pos, TileInfo::FLAG());
					$this->flags++;
				}else{
					$this->explodeUnopened($pos, $isRecursiveExplode);
				}
				break;
			case TileInfo::FLAG():
				if ($flag){
					$this->setTile($pos, TileInfo::QUESTION_MINE());
					$this->flags--;
				}
				break;
			case TileInfo::WRONG_FLAG():
				if ($flag){
					$this->setTile($pos, TileInfo::QUESTION());
					$this->flags--;
				}
				break;
			case TileInfo::QUESTION_MINE():
				if ($flag){
					$this->setTile($pos, TileInfo::MINE());
				}
				break;
			case TileInfo::QUESTION():
				if ($flag){
					$this->setTile($pos, TileInfo::UNOPENED());
				}
				break;
			case TileInfo::ONE():
			case TileInfo::TWO():
			case TileInfo::THREE():
			case TileInfo::FOUR():
			case TileInfo::FIVE():
			case TileInfo::SIX():
			case TileInfo::SEVEN():
			case TileInfo::EIGHT():
				if ($isAutoFlag){
					$this->autoFlag($pos);
				}
				$this->explodeNumber($pos, $isAutoExplode, $isRecursiveExplode);
				break;
		}
		if ($this->getUnopenedTiles() === 0){
			$this->gameWin = true;
		}
	}

	public function getMinesLeft() : int{
		return $this->mines - $this->flags;
	}

	public function getUnopenedTiles() : int{
		$unopenedTiles = 0;
		for ($i = 0; $i < $this->width; $i++){
			for ($j = 0; $j < $this->height; $j++){
				$tile = $this->getTile(new Vector2($i, $j));
				if ($tile === TileInfo::UNOPENED() || $tile === TileInfo::QUESTION() || $tile === TileInfo::WRONG_FLAG()){
					$unopenedTiles++;
				}
			}
		}
		return $unopenedTiles;
	}
}