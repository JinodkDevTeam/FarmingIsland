<?php
declare(strict_types=1);

namespace Bazaar\utils;

use CustomItems\item\CustomItemFactory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;

class ItemUtils{

	public static function toName(int $id): string{
		if ($id < 2000){
			return ItemFactory::getInstance()->get($id)->getName();
		}
		$citem = CustomItemFactory::getInstance()->get($id);
		if ($citem == null){
			return "";
		}
		return $citem->getName();
	}

	public static function toId(Item $item): int{
		$nbt = $item->getNamedTag();
		if ($nbt->getTag("CustomItemID") == null){
			if ($item->getMeta() == 0){
				return $item->getId();
			}
			$citem = CustomItemFactory::getInstance()->getMetaLessItem($item->getId(), $item->getMeta());
			if ($citem == null){
				return $item->getId();
			}
			return $citem->getId();
		}
		return (int)$nbt->getTag("CustomItemID")->getValue();
	}

	public static function toItem(int $id): ?Item{
		if ($id < 2000){
			return ItemFactory::getInstance()->get($id);
		}
		$citem = CustomItemFactory::getInstance()->get($id);
		if ($citem == null){
			return null;
		}
		return $citem->toItem();
	}

	/**
	 * @param Player $player
	 * @param Item   $other
	 *
	 * @return int
	 *
	 * @description Return count of item in player inventory
	 */
	public static function getItemCount(Player $player, Item $other): int{
		$count = 0;
		$inv = $player->getInventory();
		foreach ($inv->getContents() as $item){
			if ($item->canStackWith($other)){
				$count += $item->getCount();
			}
		}
		return $count;
	}
}