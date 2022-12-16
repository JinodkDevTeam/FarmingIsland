<?php
declare(strict_types=1);

namespace CustomItems\customies\drill;

use pocketmine\item\ToolTier;

class MegaDrill extends Drill{
	public function getBaseMiningSpeed() : int{
		return 50;
	}

	public function getTexture() : string{
		return "fici_mega_drill";
	}

	public function getBlockToolHarvestLevel() : int{
		return ToolTier::DIAMOND()->getHarvestLevel();
	}
}