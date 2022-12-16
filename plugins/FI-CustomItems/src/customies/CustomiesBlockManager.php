<?php
declare(strict_types=1);

namespace CustomItems\customies;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;

class CustomiesBlockManager{
	public static function register() : void{
		$factory = CustomiesBlockFactory::getInstance();
		$creativeInfo = $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Mithril Ore", new BlockBreakInfo(105, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 1, 6000.0)), "ficb:mithril_ore", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Titanium Ore", new BlockBreakInfo(140, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 2, 6000.0)), "ficb:titanium_ore", null, $creativeInfo);
	}
}