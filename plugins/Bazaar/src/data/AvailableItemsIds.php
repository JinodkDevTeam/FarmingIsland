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
		CustomItemIds::ENCHANTED_COBBLESTONE,
		CustomItemIds::ENCHANTED_COAL,
		CustomItemIds::ENCHANTED_COAL_BLOCK,
		CustomItemIds::ENCHANTED_IRON_INGOT,
		CustomItemIds::ENCHANTED_IRON_BLOCK,
		CustomItemIds::ENCHANTED_GOLD_INGOT,
		CustomItemIds::ENCHANTED_GOLD_BLOCK
	];
}