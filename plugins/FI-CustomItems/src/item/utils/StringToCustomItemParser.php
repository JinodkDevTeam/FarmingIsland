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

		$result->register("op_rod", fn() => CustomItemFactory::getInstance()->get(CustomItemIds::OP_ROD));

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