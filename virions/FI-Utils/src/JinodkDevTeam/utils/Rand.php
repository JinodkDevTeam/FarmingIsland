<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils;

use InvalidArgumentException;

class Rand{

	/**
	 * @param int $percent
	 *
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public static function fastChance(int $percent) : bool{
		if (($percent > 100) or ($percent < 0)){
			throw new InvalidArgumentException("Percent must be between 0 and 100");
		}
		return self::rawfastChance(1, 100, $percent);
	}

	/**
	 * @param int $min
	 * @param int $max
	 * @param int $chance
	 *
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public static function rawfastChance(int $min, int $max, int $chance) : bool{
		if(!($min <= $max)){
			throw new InvalidArgumentException("Invalid arguments");
		}
		if ($chance < $min){
			return false;
		}
		if ($chance >= $max){
			return true;
		}
		return mt_rand($min, $max) <= $chance;
	}

	/**
	 * @param array $elements
	 * @param int[] $chances
	 * @param bool  $isShuffle
	 *
	 * @return array
	 * @throw InvalidArgumentException
	 */
	public static function build_chance(array $elements, array $chances, bool $isShuffle = true) : array{
		if(count($elements) != count($chances)){
			throw new InvalidArgumentException("Elements and chances must have the same elements count");
		}
		$result = [];
		foreach($elements as $id => $element){
			if ($chances[$id] == 0) continue;
			if ($chances < 0){
				throw new InvalidArgumentException("Chances must be positive, got " . $chances[$id]);
			}
			for($i = 0; $i < $chances[$id]; $i++){
				$result[] = $element;
			}
		}
		if ($isShuffle){
			shuffle($result);
		}
		return $result;
	}

	/**
	 * @param array $elements
	 * @param int[] $chances
	 * @param bool  $isShuffle
	 *
	 * @return mixed
	 * @deprecated Due to bad performance, use build_chance() instead or fast_chance()
	 */
	public static function getRandomElement(array $elements, array $chances, bool $isShuffle = true) : mixed{
		$result = self::build_chance($elements, $chances, $isShuffle);
		return $result[array_rand($result)];
	}

	/**
	 * @param array $array
	 *
	 * @return array
	 */
	public function fromArray(array $array) : array{
		$list = []; //For storing the object appear in the array
		$count = []; //For storing the number of times the object appear in the array
		foreach($array as $key => $value){
			if (in_array($value, $list)){
				$count[array_search($value, $list)]++;
			}else{
				$list[] = $value;
				$count[] = 1;
			}
		}
		$total = array_sum($count);
		foreach($count as $key => $value){
			$count[$key] = $value / $total * 100;
		}
		return [$list, $count];
	}
}