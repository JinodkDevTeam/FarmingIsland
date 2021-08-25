<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Item;
use pocketmine\item\MilkBucket;
use pocketmine\item\Potion;
use pocketmine\item\VanillaItems;

class PotionCategory implements Category{

	public function getId() : string{
		return "Potion";
	}

	public function getDisplayName() : string{
		return "§r§l§dPotions";
	}

	public function getMenuItem() : Item{
		return VanillaItems::WATER_POTION()->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		if (($item instanceof Potion) or ($item instanceof MilkBucket)){
			return true;
		}
		return false;
	}
}