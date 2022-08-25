<?php
declare(strict_types=1);

namespace SkillLevel;

use pocketmine\utils\EnumTrait;


/**
 * @generate-registry-docblock
 *
 * @method static Skill MINING()
 * @method static Skill FISHING()
 * @method static Skill FARMING()
 * @method static Skill FORAGING()
 */
class Skill{
	use EnumTrait {
		EnumTrait::__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new self("mining"),
			new self("fishing"),
			new self("farming"),
			new self("foraging"),
		);
	}

	protected string $name;

	public function __construct(string $name){
		$this->Enum___construct($name);
		$this->name = $name;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getDisplayName() : string{
		return ucfirst($this->name);
	}

	public function getIdLevel() : string{
		return $this->getDisplayName() . "Level";
	}

	public function getIdExp() : string{
		return $this->getDisplayName(). "Exp";
	}
}