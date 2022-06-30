<?php
declare(strict_types=1);

class Season{

	public const SEASONS = [
		"Spring",
		"Summer",
		"Autumn",
		"Winter"
	];

	public static function getSeason() : string{
		$day = (int) date("d");
		if($day >= 1 && $day <= 7){
			return self::SEASONS[0];
		}
		if($day >= 8 && $day <= 15){
			return self::SEASONS[1];
		}
		if($day >= 16 && $day <= 23){
			return self::SEASONS[2];
		}
		if($day >= 24 && $day <= 31){
			return self::SEASONS[3];
		}
		return "";
	}
}