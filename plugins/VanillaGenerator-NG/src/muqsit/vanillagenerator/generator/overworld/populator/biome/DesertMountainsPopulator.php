<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator\overworld\populator\biome;

use muqsit\vanillagenerator\generator\overworld\biome\BiomeIds;

class DesertMountainsPopulator extends DesertPopulator{

	public function getBiomes() : ?array{
		return [BiomeIds::MUTATED_DESERT];
	}

	protected function initPopulators() : void{
		$this->water_lake_decorator->setAmount(1);
	}
}