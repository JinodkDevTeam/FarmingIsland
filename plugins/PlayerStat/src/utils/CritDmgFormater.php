<?php
declare(strict_types=1);

namespace PlayerStat\utils;

use pocketmine\utils\TextFormat;

class CritDmgFormater{

	const COLORS = [
		TextFormat::WHITE,
		TextFormat::YELLOW,
		TextFormat::GOLD,
		TextFormat::RED,
		TextFormat::RED,
		TextFormat::WHITE
	];

	public static function format(float $damage) : string{
		$string = (string)$damage;
		$format = TextFormat::RESET;
		for($i = 0; $i < strlen($string); $i++){
			$color = self::COLORS[$i % count(self::COLORS)];
			$format .= $color . $string[$i];
		}
		return TextFormat::WHITE . "✧" . $format . self::COLORS[($i + 1) % count(self::COLORS)] . "✧";
	}
}