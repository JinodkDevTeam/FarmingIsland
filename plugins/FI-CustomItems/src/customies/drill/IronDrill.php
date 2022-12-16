<?php
declare(strict_types=1);

namespace CustomItems\customies\drill;

use pocketmine\item\ToolTier;

class IronDrill extends Drill{
	public function getBaseMiningSpeed() : int{
		return 15;
	}

	public function getTexture() : string{
		return "fici_iron_drill";
	}

	public function getBlockToolHarvestLevel() : int{
		return ToolTier::IRON()->getHarvestLevel();
	}
}