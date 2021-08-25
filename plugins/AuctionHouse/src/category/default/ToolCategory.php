<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\item\VanillaItems;

class ToolCategory implements Category{


	public function getId() : string{
		return "Tool";
	}

	public function getDisplayName() : string{
		return "§r§l§eTools";
	}

	public function getMenuItem() : Item{
		return VanillaItems::DIAMOND_AXE()->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		if ($item instanceof Tool){
			return true;
		}
		return false;
	}
}