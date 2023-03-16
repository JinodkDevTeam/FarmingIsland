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
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Mithril Ore", new BlockBreakInfo(105, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 1, 6000.0)), "ficb:mithril_ore", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Titanium Ore", new BlockBreakInfo(140, BlockToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel() + 2, 6000.0)), "ficb:titanium_ore", null, $creativeInfo);
		$material = new Material(Material::TARGET_ALL, "table", Material::RENDER_METHOD_ALPHA_TEST);
		$model = new Model([$material], "geometry.ficb.table", new Vector3(-8, 0, -8), new Vector3(16, 16, 16));
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Table", new BlockBreakInfo(10, BlockToolType::AXE, ToolTier::WOOD()->getHarvestLevel(), 10)), "ficb:table", $model, $creativeInfo);

		//For minesweeper
		self::registerMineSweeperRP();
	}

	public static function registerMineSweeperRP() : void{
		$factory = CustomiesBlockFactory::getInstance();
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_CONSTRUCTION);
		$blockBreakInfo = BlockBreakInfo::instant();
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "One", BlockBreakInfo::instant()), "ms:one", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Two", BlockBreakInfo::instant()), "ms:two", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Three", BlockBreakInfo::instant()), "ms:three", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Four", BlockBreakInfo::instant()), "ms:four", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Five", BlockBreakInfo::instant()), "ms:five", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Six", BlockBreakInfo::instant()), "ms:six", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Seven", BlockBreakInfo::instant()), "ms:seven", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Eight", BlockBreakInfo::instant()), "ms:eight", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Mine", BlockBreakInfo::instant()), "ms:mine", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Booom", BlockBreakInfo::instant()), "ms:mine_red", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Wrong Mine", BlockBreakInfo::instant()), "ms:mine_red_cross", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Flag", BlockBreakInfo::instant()), "ms:flag", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Question", BlockBreakInfo::instant()), "ms:question", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Empty", BlockBreakInfo::instant()), "ms:empty", null, $creativeInfo);
		$factory->registerBlock(fn(int $id) => new Opaque(new BlockIdentifier($id, 0), "Unopened", BlockBreakInfo::instant()), "ms:unopened", null, $creativeInfo);
	}
}