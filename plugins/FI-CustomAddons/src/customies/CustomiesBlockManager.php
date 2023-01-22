<?php
declare(strict_types=1);

namespace CustomAddons\customies;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\Opaque;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;

class CustomiesBlockManager{
	public static function register() : void{
		$factory = CustomiesBlockFactory::getInstance();
		$creativeInfo = $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Mithril Ore", new BlockBreakInfo(105, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 1, 6000.0)), "ficb:mithril_ore", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Titanium Ore", new BlockBreakInfo(140, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 2, 6000.0)), "ficb:titanium_ore", null, $creativeInfo);
		$material = new Material(Material::TARGET_ALL, "table", Material::RENDER_METHOD_ALPHA_TEST);
		$model = new Model([$material], "geometry.ficb.table", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Table", new BlockBreakInfo(10, BlockToolType::AXE, ToolTier::WOOD()->getHarvestLevel(), 10)), "ficb:table", $model, $creativeInfo);
	}
}