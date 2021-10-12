<?php
declare(strict_types=1);

namespace CustomItems\item\utils;

class RarityHelper{
	public static function toString(Rarity $rarity) : string{
		return match ($rarity) {
			Rarity::COMMON() => "§l§fCommon",
			Rarity::UNCOMMON() => "§l§aUncommon",
			Rarity::RARE() => "§l§eRare",
			Rarity::EPIC() => "§l§5Epic",
			Rarity::LEGENDARY() => "§l§6Legendary",
			Rarity::MYTHIC() => "§l§9Mythic",
			Rarity::DIVINE() => "§l§bDivine",
			Rarity::SPECIAL() => "§l§cSpecial",
			Rarity::VERY_SPECIAL() => "§l§cVery Special",
			Rarity::ULTIMATE() => "§l§dUltimate",
			default => "",
		};
	}

	public static function toColor(Rarity $rarity) : string{
		return match ($rarity) {
			Rarity::COMMON() => "§r§f",
			Rarity::UNCOMMON() => "§r§a",
			Rarity::RARE() => "§r§e",
			Rarity::EPIC() => "§r§5",
			Rarity::LEGENDARY() => "§r§6",
			Rarity::MYTHIC() => "§r§9",
			Rarity::DIVINE() => "§l§b",
			Rarity::SPECIAL(), Rarity::VERY_SPECIAL() => "§r§c",
			Rarity::ULTIMATE() => "§r§d",
			default => "",
		};
	}
}