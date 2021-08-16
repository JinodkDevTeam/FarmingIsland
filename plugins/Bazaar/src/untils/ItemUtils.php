<?php
declare(strict_types=1);

namespace Bazaar\utils;

use CustomItems\item\CustomItemFactory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class ItemUtils{

	public static function toName(int $id): string{
		if ($id < 2000){
			$item = ItemFactory::getInstance()->get($id);
			return $item->getName();
		}
		$citem = CustomItemFactory::getInstance()->get($id);
		if ($citem == null){
			return "";
		}
		return $citem->toItem()->getName();
	}

	public static function toId(Item $item): int{
		$nbt = $item->getNamedTag();
		if ($nbt->getTag("CustomItemID") == null){
			if ($item->getMeta() == 0){
				return $item->getId();
			}

		}
		return (int)$nbt->getTag("CustomItemID")->getValue();
	}
}