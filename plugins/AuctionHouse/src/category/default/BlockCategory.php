<?php
declare(strict_types=1);

namespace AuctionHouse\category\default;

use AuctionHouse\category\Category;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class BlockCategory implements Category{

	public function getId() : string{
		return "Block";
	}

	public function getDisplayName() : string{
		return "§r§l§bBlocks";
	}

	public function getMenuItem() : Item{
		return ItemFactory::getInstance()->get(ItemIds::BRICK_BLOCK)->setCustomName($this->getDisplayName());
	}

	public function isInCategory(Item $item) : bool{
		if ($item instanceof ItemBlock){
			return true;
		}
		return false;
	}
}