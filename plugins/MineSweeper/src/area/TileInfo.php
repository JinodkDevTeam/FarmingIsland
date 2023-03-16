<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area;

use pocketmine\utils\EnumTrait;

/**
 * @method static TileInfo ONE()
 * @method static TileInfo TWO()
 * @method static TileInfo THREE()
 * @method static TileInfo FOUR()
 * @method static TileInfo FIVE()
 * @method static TileInfo SIX()
 * @method static TileInfo SEVEN()
 * @method static TileInfo EIGHT()
 * @method static TileInfo MINE()
 * @method static TileInfo MINE_EXPLODED()
 * @method static TileInfo WRONG_FLAG()
 * @method static TileInfo FLAG()
 * @method static TileInfo QUESTION()
 * @method static TileInfo EMPTY()
 * @method static TileInfo UNOPENED()
 * @method static TileInfo QUESTION_MINE()
 * @method static TileInfo SAFE_TILE()
 */

class TileInfo{
	use EnumTrait{
		EnumTrait::__construct as Enum___construct;
	}
	protected static function setup() : void{
		self::registerAll(
			new TileInfo("unopened", -1),
			new TileInfo("empty", 0),
			new TileInfo("one", 1, true),
			new TileInfo("two", 2, true),
			new TileInfo("three", 3, true),
			new TileInfo("four", 4, true),
			new TileInfo("five", 5, true),
			new TileInfo("six", 6, true),
			new TileInfo("seven", 7, true),
			new TileInfo("eight", 8, true),
			new TileInfo("mine", 9),
			new TileInfo("mine_exploded", 10),
			new TileInfo("wrong_flag", 11),
			new TileInfo("flag", 12),
			new TileInfo("question", 13),
			new TileInfo("question_mine", 14), // For Question flag in mine tile
			new TileInfo("safe_tile", 15) //For generating mines
		);
	}

	public function __construct(
		protected string $name,
		protected int $id,
		protected bool $isNumber = false
	){
		$this->Enum___construct($name);
	}

	public function getName() : string{
		return $this->name;
	}

	public function getId() : int{
		return $this->id;
	}

	public function isNumber() : bool{
		return $this->isNumber;
	}

	public static function fromName(string|int $name) : TileInfo{
		return match ($name) {
			"empty", "0", 0 => self::EMPTY(),
			"one", "1", 1 => self::ONE(),
			"two", "2", 2 => self::TWO(),
			"three", "3", 3 => self::THREE(),
			"four", "4", 4 => self::FOUR(),
			"five", "5", 5 => self::FIVE(),
			"six", "6", 6 => self::SIX(),
			"seven", "7", 7 => self::SEVEN(),
			"eight", "8", 8 => self::EIGHT(),
			"mine", "9", 9 => self::MINE(),
			"mine_exploded", "exploded_mine", "mine_red", "10", 10 => self::MINE_EXPLODED(),
			"mine_red_cross", "wrong_flag", "11", 11 => self::WRONG_FLAG(),
			"flag", "12", 12 => self::FLAG(),
			"question", "13", 13 => self::QUESTION(),
			"question_mine", "14", 14 => self::QUESTION_MINE(),
			"safe_tile", "15", 15 => self::SAFE_TILE(),
			default => self::UNOPENED()
		};
	}
}