<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils;

use CustomItems\item\CustomItemFactory;
use pocketmine\inventory\Inventory;
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

	/**
	 * @param Inventory $inventory
	 * @param Item      ...$slots
	 *
	 * @return Item[]
	 *
	 * @description Copy-pasta of PM removeItem() with more strict item NamedTag check...
	 */
	public static function removeItem(Inventory $inventory, Item ...$slots) : array{
		/** @var Item[] $itemSlots */
		/** @var Item[] $slots */
		$itemSlots = [];
		foreach($slots as $slot){
			if(!$slot->isNull()){
				$itemSlots[] = clone $slot;
			}
		}
		for($i = 0, $size = $inventory->getSize(); $i < $size; ++$i){
			$item = $inventory->getItem($i);
			if($item->isNull()){
				continue;
			}
			foreach($itemSlots as $index => $slot){
				if($slot->equals($item, !$slot->hasAnyDamageValue(), true)){
					$amount = min($item->getCount(), $slot->getCount());
					$slot->setCount($slot->getCount() - $amount);
					$item->setCount($item->getCount() - $amount);
					$inventory->setItem($i, $item);
					if($slot->getCount() <= 0){
						unset($itemSlots[$index]);
					}
				}
			}
			if(count($itemSlots) === 0){
				break;
			}
		}
		return $itemSlots;
	}

	public static function toString(Item $item): string{
		return utf8_encode(serialize($item));
	}

	public static function fromString(string $string): Item{
		return unserialize(utf8_decode($string));
	}
}