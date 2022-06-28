<?php
declare(strict_types=1);

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
		return self::rawfastChance(0, 100, $percent);
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
		if(!(($min <= $max) && ($chance <= $max) && ($min <= $chance))){
			throw new InvalidArgumentException("Invalid arguments");
		}
		return mt_rand($min, $max) <= $chance;
	}

	/**
	 * @param array $elements
	 * @param int[] $chances
	 *
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public static function build_chance(array $elements, array $chances) : array{
		if(count($elements) != count($chances)){
			throw new InvalidArgumentException("Elements and chances must have the same elements");
		}
		$result = [];
		foreach($elements as $id => $element){
			for($i = 0; $i < $chances[$id]; $i++){
				$result[] = $element;
			}
		}
		return $result;
	}
}