<?php
declare(strict_types=1);

namespace CustomItems\item;

class RarityType{

	public const COMMON = 0;
	public const UNCOMMON = 1;
	public const RARE = 2;
	public const EPIC = 3;
	public const LEGENDARY = 4;
	public const MYTHIC = 5;
	public const SPECIAL = 6;
	public const VERY_SPECIAL = 7;
	public const ULTIMATE = 8;

	public static function toString(int $code): string{
		return match ($code) {
			self::COMMON => "§l§fCommon",
			self::UNCOMMON => "§l§aUncommon",
			self::RARE => "§l§eRare",
			self::EPIC => "§l§5Epic",
			self::LEGENDARY => "§l§6Legendary",
			self::MYTHIC => "§l§bMythic",
			self::SPECIAL => "§l§cSpecial",
			self::VERY_SPECIAL => "§l§cVery Special",
			self::ULTIMATE => "§l§dUltimate",
			default => "",
		};
	}
}