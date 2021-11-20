<?php /** @noinspection ALL */
declare(strict_types=1);

namespace CustomItems\item\utils;

use pocketmine\utils\EnumTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static Rarity COMMON()
 * @method static Rarity UNCOMMON()
 * @method static Rarity RARE()
 * @method static Rarity EPIC()
 * @method static Rarity LEGENDARY()
 * @method static Rarity MYTHIC()
 * @method static Rarity DIVINE()
 * @method static Rarity SPECIAL()
 * @method static Rarity VERY_SPECIAL()
 * @method static Rarity ULTIMATE()
 */

final class Rarity{
	use EnumTrait {
		EnumTrait::__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new self("common", "COMMON", 0),
			new self("uncommon", "UNCOMMON", 1),
			new self("rare","RARE", 2),
			new self("epic", "EPIC",  3),
			new self("legendary", "LEGENDARY", 4),
			new self("mythic", "MYTHIC", 5),
			new self("divine", "DIVINE", 6),
			new self("special", "SPECIAL", 7),
			new self("very_special", "VERY SPECIAL", 8),
			new self("ultimate", "ULTIMATE", 9)
		);
	}

	private string $displayName;
	private int $rarity_id;

	public function __construct(string $enumName, string $displayName, int $rarity_id){
		$this->Enum___construct($enumName);
		$this->displayName = $displayName;
		$this->rarity_id = $rarity_id;
	}

	public function getDisplayName(): string{
		return $this->displayName;
	}

	public function getRarityId(): int{
		return $this->rarity_id;
	}
}