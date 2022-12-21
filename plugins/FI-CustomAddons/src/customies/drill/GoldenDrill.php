<?php
declare(strict_types=1);

namespace CustomAddons\customies\drill;

use pocketmine\item\ToolTier;

class GoldenDrill extends Drill{
	public function getBaseMiningSpeed() : int{
		return 25;
	}

	public function getTexture() : string{
		return "fici_golden_drill";
	}

	public function getBlockToolHarvestLevel() : int{
		return ToolTier::GOLD()->getHarvestLevel();
	}
}