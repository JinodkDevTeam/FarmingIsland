<?php
declare(strict_types=1);

namespace Bazaar\data;

use pocketmine\item\ItemIds;

final class BazaarItemIds{

	//VanillaItems
	public const COBBLESTONE = ItemIds::COBBLESTONE;
	public const COAL = ItemIds::COAL;
	public const IRON_INGOT = ItemIds::IRON_INGOT;
	public const GOLD_INGOT = ItemIds::GOLD_INGOT;
	public const WHEAT = ItemIds::WHEAT;

	//CustomItems
	public const ENCHANTED_COBBLESTONE = 2000;
	public const ENCHANTED_COAL = 2001;
	public const ENCHANTED_IRON_INGOT = 2002;
	public const ENCHANTED_GOLD = 2003;
	public const ENCHANTED_WHEAT = 2004;

}