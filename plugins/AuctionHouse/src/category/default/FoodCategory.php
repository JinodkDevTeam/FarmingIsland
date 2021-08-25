<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Food;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class FoodCategory implements Category{


	public function getId() : string{
		return "Food";
	}

	public function getDisplayName() : string{
		return "§r§l§6Food";
	}

	public function getMenuItem() : Item{
		return VanillaItems::APPLE()->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		if ($item instanceof Food){
			return true;
		}
		return false;
	}
}