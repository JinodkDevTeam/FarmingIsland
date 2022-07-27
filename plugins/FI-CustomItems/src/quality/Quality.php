<?php
declare(strict_types=1);

namespace CustomItems\quality;

use pocketmine\utils\EnumTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @generate-registry-docblock
 *
 * @method static Quality NORMAL()
 * @method static Quality SILVER()
 * @method static Quality GOLD()
 * @method static Quality DIAMOND()
 */

class Quality{
	use EnumTrait {
		EnumTrait::__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new self("normal", QualityIds::NORMAL, "Normal", QualityIds::NORMAL_COLOR),
			new self("silver", QualityIds::SILVER, "Silver", QualityIds::SILVER_COLOR),
			new self("gold", QualityIds::GOLD, "Gold", QualityIds::GOLD_COLOR),
			new self("diamond", QualityIds::DIAMOND, "Diamond", QualityIds::DIAMOND_COLOR)
		);
	}

	private int $id;
	private string $name;
	private string $color;

	public function __construct(string $enumName, int $id, string $name, string $color){
		$this->Enum___construct($enumName);
		$this->id = $id;
		$this->name = $name;
		$this->color = $color;
	}

	public function getId(): int{
		return $this->id;
	}

	public function getName(): string{
		return $this->name;
	}

	public function getColor(): string{
		return $this->color;
	}

	public static function fromId(int $id): ?Quality{
		foreach(self::getAll() as $quality){
			if($quality->getId() === $id){
				return $quality;
			}
		}
		return null;
	}

	public function increaseQuality() : Quality{
		return match ($this->getId()) {
			QualityIds::NORMAL => self::SILVER(),
			QualityIds::SILVER => self::GOLD(),
			QualityIds::GOLD, QualityIds::DIAMOND => self::DIAMOND(),
			default => self::NORMAL(),
		};
	}
}