<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area\texture;

use NgLam2911\MineSweeper\area\TileInfo;
use pocketmine\block\Block;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;

class VanillaTexture extends AreaTexture{

	public function parseTile(TileInfo $tile, int $mode) : Block{
		switch($tile){
			case TileInfo::UNOPENED():
				return VanillaBlocks::QUARTZ();
			case TileInfo::EMPTY():
				return VanillaBlocks::AIR();
			case TileInfo::MINE():
				switch($mode){
					case self::MODE_PLAYING:
						return VanillaBlocks::QUARTZ();
					case self::MODE_WIN:
						return VanillaBlocks::GOLD(); //Flagged
					case self::MODE_LOSE:
						return VanillaBlocks::TNT();
				}
				break;
			case TileInfo::MINE_EXPLODED():
				return VanillaBlocks::BEDROCK();
			case TileInfo::WRONG_FLAG():
				switch($mode){
					case self::MODE_WIN:
					case self::MODE_PLAYING:
						return VanillaBlocks::GOLD();
					case self::MODE_LOSE:
						return VanillaBlocks::REDSTONE();
				}
				break;
			case TileInfo::FLAG():
				return VanillaBlocks::GOLD();
			case TileInfo::QUESTION_MINE():
			case TileInfo::QUESTION():
				return VanillaBlocks::IRON();
			case TileInfo::ONE():
				return VanillaBlocks::WOOL()->setColor(DyeColor::BLUE());
			case TileInfo::TWO():
				return VanillaBlocks::WOOL()->setColor(DyeColor::GREEN());
			case TileInfo::THREE():
				return VanillaBlocks::WOOL()->setColor(DyeColor::RED());
			case TileInfo::FOUR():
				return VanillaBlocks::WOOL()->setColor(DyeColor::PURPLE());
			case TileInfo::FIVE():
				return VanillaBlocks::WOOL()->setColor(DyeColor::BROWN());
			case TileInfo::SIX():
				return VanillaBlocks::WOOL()->setColor(DyeColor::CYAN());
			case TileInfo::SEVEN():
				return VanillaBlocks::WOOL()->setColor(DyeColor::BLACK());
			case TileInfo::EIGHT():
				return VanillaBlocks::WOOL()->setColor(DyeColor::GRAY());
		}
		return VanillaBlocks::AIR();
	}

	public function getName() : string{
		return "vanilla";
	}
}