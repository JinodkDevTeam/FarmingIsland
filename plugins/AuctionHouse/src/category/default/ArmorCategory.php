<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class ArmorCategory implements Category{

	public function getId() : string{
		return "Armor";
	}

	public function getDisplayName() : string{
		return "§r§l§aArmor";
	}

	public function getMenuItem() : Item{
		return VanillaItems::DIAMOND_CHESTPLATE()->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		if ($item instanceof Armor){
			return true;
		}
		return false;
	}
}