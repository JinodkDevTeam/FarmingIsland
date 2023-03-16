<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area\texture;

use CustomAddons\customies\CustomiesBlocks;
use NgLam2911\MineSweeper\area\TileInfo;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;

class ClassicTexture extends AreaTexture{

	public function parseTile(TileInfo $tile, int $mode) : Block{
		switch($tile){
			case TileInfo::UNOPENED():
				return CustomiesBlocks::UNOPENED();
			case TileInfo::EMPTY():
				return CustomiesBlocks::EMPTY();
			case TileInfo::MINE():
				switch($mode){
					case self::MODE_PLAYING:
						return CustomiesBlocks::UNOPENED();
					case self::MODE_WIN:
						return CustomiesBlocks::FLAG(); //Flagged
					case self::MODE_LOSE:
						return CustomiesBlocks::MINE();
				}
				break;
			case TileInfo::MINE_EXPLODED():
				return CustomiesBlocks::MINE_RED();
			case TileInfo::WRONG_FLAG():
				switch($mode){
					case self::MODE_WIN:
					case self::MODE_PLAYING:
						return CustomiesBlocks::FLAG();
					case self::MODE_LOSE:
						return CustomiesBlocks::MINE_RED_CROSS();
				}
				break;
			case TileInfo::FLAG():
				return CustomiesBlocks::FLAG();
			case TileInfo::QUESTION_MINE():
			case TileInfo::QUESTION():
				return CustomiesBlocks::QUESTION();
			case TileInfo::ONE():
				return CustomiesBlocks::ONE();
			case TileInfo::TWO():
				return CustomiesBlocks::TWO();
			case TileInfo::THREE():
				return CustomiesBlocks::THREE();
			case TileInfo::FOUR():
				return CustomiesBlocks::FOUR();
			case TileInfo::FIVE():
				return CustomiesBlocks::FIVE();
			case TileInfo::SIX():
				return CustomiesBlocks::SIX();
			case TileInfo::SEVEN():
				return CustomiesBlocks::SEVEN();
			case TileInfo::EIGHT():
				return CustomiesBlocks::EIGHT();
		}
		return VanillaBlocks::AIR();
	}

	public function getName() : string{
		return "classic";
	}
}