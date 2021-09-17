<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator\overworld\populator\biome;

use muqsit\vanillagenerator\generator\object\tree\BirchTree;
use muqsit\vanillagenerator\generator\object\tree\TallBirchTree;
use muqsit\vanillagenerator\generator\overworld\biome\BiomeIds;
use muqsit\vanillagenerator\generator\overworld\decorator\types\TreeDecoration;

class BirchForestMountainsPopulator extends ForestPopulator{

	private const BIOMES = [BiomeIds::MUTATED_BIRCH_FOREST, BiomeIds::MUTATED_BIRCH_FOREST_HILLS];

	/** @var TreeDecoration[] */
	protected static array $TREES;

	protected static function initTrees() : void{
		self::$TREES = [
			new TreeDecoration(BirchTree::class, 1),
			new TreeDecoration(TallBirchTree::class, 1)
		];
	}

	public function getBiomes() : ?array{
		return self::BIOMES;
	}

	protected function initPopulators() : void{
		$this->tree_decorator->setTrees(...self::$TREES);
	}
}

BirchForestMountainsPopulator::init();