<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator\biomegrid;

use muqsit\vanillagenerator\generator\overworld\biome\BiomeIds;
use function array_key_exists;

class ShoreMapLayer extends MapLayer{

	/** @var int[] */
	private static array $OCEANS = [BiomeIds::OCEAN => 0, BiomeIds::DEEP_OCEAN => 0];

	/** @var int[] */
	private static array $SPECIAL_SHORES = [
		BiomeIds::EXTREME_HILLS => BiomeIds::STONE_BEACH,
		BiomeIds::EXTREME_HILLS_WITH_TREES => BiomeIds::STONE_BEACH,
		BiomeIds::MUTATED_EXTREME_HILLS => BiomeIds::STONE_BEACH,
		BiomeIds::MUTATED_EXTREME_HILLS_WITH_TREES => BiomeIds::STONE_BEACH,
		BiomeIds::ICE_FLATS => BiomeIds::COLD_BEACH,
		BiomeIds::ICE_MOUNTAINS => BiomeIds::COLD_BEACH,
		BiomeIds::MUTATED_ICE_FLATS => BiomeIds::COLD_BEACH,
		BiomeIds::TAIGA_COLD => BiomeIds::COLD_BEACH,
		BiomeIds::TAIGA_COLD_HILLS => BiomeIds::COLD_BEACH,
		BiomeIds::MUTATED_TAIGA_COLD => BiomeIds::COLD_BEACH,
		BiomeIds::MUSHROOM_ISLAND => BiomeIds::MUSHROOM_ISLAND_SHORE,
		BiomeIds::SWAMPLAND => BiomeIds::SWAMPLAND,
		BiomeIds::MESA => BiomeIds::MESA,
		BiomeIds::MESA_ROCK => BiomeIds::MESA_ROCK,
		BiomeIds::MUTATED_MESA_ROCK => BiomeIds::MUTATED_MESA_ROCK,
		BiomeIds::MESA_CLEAR_ROCK => BiomeIds::MESA_CLEAR_ROCK,
		BiomeIds::MUTATED_MESA_CLEAR_ROCK => BiomeIds::MUTATED_MESA_CLEAR_ROCK,
		BiomeIds::MUTATED_MESA => BiomeIds::MUTATED_MESA
	];

	public function __construct(int $seed, private MapLayer $below_layer){
		parent::__construct($seed);
	}

	public function generateValues(int $x, int $z, int $size_x, int $size_z) : array{
		$grid_x = $x - 1;
		$grid_z = $z - 1;
		$grid_size_x = $size_x + 2;
		$grid_size_z = $size_z + 2;
		$values = $this->below_layer->generateValues($grid_x, $grid_z, $grid_size_x, $grid_size_z);

		$final_values = [];
		for($i = 0; $i < $size_z; ++$i){
			for($j = 0; $j < $size_x; ++$j){
				// This applies shores using Von Neumann neighborhood
				// it takes a 3x3 grid with a cross shape and analyzes values as follow
				// 0X0
				// XxX
				// 0X0
				// the grid center value decides how we are proceeding:
				// - if it's not ocean and it's surrounded by at least 1 ocean cell
				// it turns the center value into beach.
				$upper_val = $values[$j + 1 + $i * $grid_size_x];
				$lower_val = $values[$j + 1 + ($i + 2) * $grid_size_x];
				$left_val = $values[$j + ($i + 1) * $grid_size_x];
				$right_val = $values[$j + 2 + ($i + 1) * $grid_size_x];
				$center_val = $values[$j + 1 + ($i + 1) * $grid_size_x];
				if(!array_key_exists($center_val, self::$OCEANS) && (
						array_key_exists($upper_val, self::$OCEANS) || array_key_exists($lower_val, self::$OCEANS)
						|| array_key_exists($left_val, self::$OCEANS) || array_key_exists($right_val, self::$OCEANS)
					)){
					$final_values[$j + $i * $size_x] = self::$SPECIAL_SHORES[$center_val] ?? BiomeIds::BEACH;
				}else{
					$final_values[$j + $i * $size_x] = $center_val;
				}
			}
		}

		return $final_values;
	}
}