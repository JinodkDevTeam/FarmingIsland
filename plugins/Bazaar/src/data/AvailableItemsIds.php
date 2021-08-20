<?php
declare(strict_types=1);

namespace Bazaar\data;

use CustomItems\item\CustomItemIds;
use pocketmine\item\ItemIds;

final class AvailableItemsIds{

	public const Ids = [
		ItemIds::COBBLESTONE,
		ItemIds::COAL,
		ItemIds::IRON_INGOT,
		ItemIds::GOLD_INGOT,
		CustomItemIds::LAPIS_LAZULI,
		ItemIds::REDSTONE_DUST,
		ItemIds::EMERALD,
		ItemIds::DIAMOND,
		CustomItemIds::ENCHANTED_COBBLESTONE,
		CustomItemIds::ENCHANTED_COAL,
		CustomItemIds::ENCHANTED_COAL_BLOCK,
		CustomItemIds::ENCHANTED_IRON_INGOT,
		CustomItemIds::ENCHANTED_IRON_BLOCK,
		CustomItemIds::ENCHANTED_GOLD_INGOT,
		CustomItemIds::ENCHANTED_GOLD_BLOCK,
		CustomItemIds::ENCHANTED_LAPIS,
		CustomItemIds::ENCHANTED_LAPIS_BLOCK,
		CustomItemIds::ENCHANTED_REDSTONE,
		CustomItemIds::ENCHANTED_REDSTONE_BLOCK,
		CustomItemIds::ENCHANTED_EMERALD,
		CustomItemIds::ENCHANTED_EMERALD_BLOCK,
		CustomItemIds::ENCHANTED_DIAMOND,
		CustomItemIds::ENCHANTED_DIAMOND_BLOCK
	];
}