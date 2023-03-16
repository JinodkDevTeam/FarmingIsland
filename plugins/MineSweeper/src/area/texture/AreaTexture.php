<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area\texture;

use NgLam2911\MineSweeper\area\TileInfo;
use pocketmine\block\Block;

abstract class AreaTexture{

	public const MODE_PLAYING = 0;
	public const MODE_LOSE = 1;
	public const MODE_WIN = 2;

	public abstract function parseTile(TileInfo $tile, int $mode) : Block;

	public function getName() : string{
		return "";
	}
}