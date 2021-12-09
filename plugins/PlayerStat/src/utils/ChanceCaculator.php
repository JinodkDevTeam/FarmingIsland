<?php
declare(strict_types=1);

namespace PlayerStat\utils;

class ChanceCaculator{

	public static function chance(int $ratio = 0) : bool{
		if ($ratio == 0){
			return false;
		}
		if ($ratio == 100){
			return true;
		}
		if ($ratio > 100){
			return true;
		}
		$rand = mt_rand(0, 100);
		if ($rand <= $ratio){
			return true;
		}
		return false;
	}
}