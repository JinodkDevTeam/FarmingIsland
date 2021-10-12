<?php
declare(strict_types=1);

namespace CustomItems\item\utils;

class RarityHelper{
	public static function toString(Rarity $rarity) : string{
		return match ($rarity) {
			Rarity::COMMON() => "§r§l§fCommon",
			Rarity::UNCOMMON() => "§r§l§aUncommon",
			Rarity::RARE() => "§r§l§eRare",
			Rarity::EPIC() => "§r§l§5Epic",
			Rarity::LEGENDARY() => "§r§l§6Legendary",
			Rarity::MYTHIC() => "§r§l§9Mythic",
			Rarity::DIVINE() => "§r§l§bDivine",
			Rarity::SPECIAL() => "§r§l§cSpecial",
			Rarity::VERY_SPECIAL() => "§r§l§cVery Special",
			Rarity::ULTIMATE() => "§r§l§dUltimate",
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
			Rarity::DIVINE() => "§r§b",
			Rarity::SPECIAL(), Rarity::VERY_SPECIAL() => "§r§c",
			Rarity::ULTIMATE() => "§r§d",
			default => "",
		};
	}
}