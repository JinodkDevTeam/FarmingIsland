<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class OtherCategory implements Category{

	public function getId() : string{
		return "Other";
	}

	public function getDisplayName() : string{
		return "§r§l§fOther";
	}

	public function getMenuItem() : Item{
		return VanillaItems::STICK()->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		return true;
	}
}