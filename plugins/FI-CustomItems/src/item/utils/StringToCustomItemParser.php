<?php
declare(strict_types=1);

namespace CustomItems\item\utils;

use CustomItems\item\CustomItem;
use CustomItems\item\CustomItemFactory;
use CustomItems\item\CustomItemIds;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\StringToTParser;

class StringToCustomItemParser extends StringToTParser{
	use SingletonTrait;

	private static function make(): self{
		$result = new self;

		$result->register("enchanted_cobblestone", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_COBBLESTONE));
		$result->register("enchanted_coal", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_COAL));
		$result->register("enchanted_coal_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_COAL_BLOCK));
		$result->register("enchanted_iron_ingot", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_IRON_INGOT));
		$result->register("enchanted_iron_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_IRON_BLOCK));
		$result->register("enchanted_gold_ingot", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GOLD_INGOT));
		$result->register("enchanted_gold_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GOLD_BLOCK));
		$result->register("enchanted_lapis", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_LAPIS));
		$result->register("enchanted_lapis_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_LAPIS_BLOCK));
		$result->register("enchanted_redstone", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_REDSTONE));
		$result->register("enchanted_redstone_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_REDSTONE_BLOCK));
		$result->register("enchanted_emerald", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_EMERALD));
		$result->register("enchanted_emerald_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_EMERALD_BLOCK));
		$result->register("enchanted_diamond", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_DIAMOND));
		$result->register("enchanted_diamond_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_DIAMOND_BLOCK));
		$result->register("enchanted_flint", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_FLINT));
		$result->register("enchanted_sand", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SAND));
		$result->register("enchanted_clay", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_CLAY));
		$result->register("enchanted_snow", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SNOW));
		$result->register("enchanted_ice", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_ICE));
		$result->register("enchanted_packed_ice", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_PACKED_ICE));
		$result->register("enchanted_blue_ice", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_BLUE_ICE));
		$result->register("enchanted_glowstone_dust", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GLOWSTONE_DUST));
		$result->register("enchanted_glowstone", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GLOWSTONE));
		$result->register("enchanted_netherrack", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_NETHERRACK));
		$result->register("enchanted_endstone", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_ENDSTONE));
		$result->register("enchanted_obsidian", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_OBSIDIAN));
		$result->register("enchanted_seed", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SEED));
		$result->register("enchanted_wheat", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_WHEAT));
		$result->register("enchanted_hay_bale", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_HAY_BALE));
		$result->register("enchanted_carrot", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_CARROT));
		$result->register("enchanted_golden_carrot", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GOLDEN_CARROT));
		$result->register("enchanted_potato", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_POTATO));
		$result->register("enchanted_sugar", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SUGAR));
		$result->register("enchanted_sugar_cane", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SUGAR_CANE));
		$result->register("enchanted_apple", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_APPLE));
		$result->register("enchanted_pumkin", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_PUMKIN));
		$result->register("enchanted_melon", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_MELON));
		$result->register("enchanted_melon_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_MELON_BLOCK));
		$result->register("enchanted_glisterin_melon", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_GLISTERIN_MELON));
		$result->register("enchanted_cactus", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_CACTUS));
		$result->register("enchanted_netherwart", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_NETHERWART));
		$result->register("enchanted_netherwart_block", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_NETHERWART_BLOCK));

		$result->register("enchanted_oak_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_OAK_WOOD));
		$result->register("enchanted_birch_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_BIRCH_WOOD));
		$result->register("enchanted_spruce_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_SPRUCE_WOOD));
		$result->register("enchanted_jungle_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_JUNGLE_WOOD));
		$result->register("enchanted_acia_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_ACIA_WOOD));
		$result->register("enchanted_dark_oak_wood", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::ENCHANTED_DARK_OAK_WOOD));

		$result->register("refined_iron", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::REFINED_IRON));
		$result->register("refined_gold", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::REFINED_GOLD));
		$result->register("refined_emerald", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::REFINED_EMERALD));
		$result->register("refined_diamond", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::REFINED_DIAMOND));
		$result->register("refined_titanium", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::REFINED_TITANIUM));

		$result->register("noice_paper", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::NOICE_PAPER));

		$result->register("crook", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::CROOK));
		$result->register("titanium_drill", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::TITANIUM_DRILL));
		$result->register("drill_fuel", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::DRILL_FUEL));

		$result->register("backpack_slot", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::BACKPACK_SLOT));

		$result->register("op_rod", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::OP_ROD));
		$result->register("starter_rod", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::STARTER_ROD));

		$result->register("game_breaker", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::GAME_BREAKER));
		$result->register("game_annihilator", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::GAME_ANNIHILATOR));
		return $result;
	}

	/**
	 * @param string $input
	 *
	 * @return CustomItem|null
	 */
	public function parse(string $input) : ?CustomItem{
		return parent::parse($input);
	}
}