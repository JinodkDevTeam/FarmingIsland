<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils;

use CustomAddons\item\CustomItems;
use Exception;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat;
use RuntimeException;

class ItemUtils{

	public static function toName(string $id): string{
		$item = StringToItemParser::getInstance()->parse($id);
		if (!is_null($item)){
			return $item->getName();
		}
		$citem = CustomItems::get($id);
		if ($citem == null){
			return "";
		}
		return $citem->getName();
	}

	public static function toId(Item $item): string{
		$nbt = $item->getNamedTag();
		if ($nbt->getTag("CustomItemID") == null){
			return self::vanillaItemMapping($item);
		}
		$namespaceid = (string)$nbt->getTag("CustomItemID")->getValue();
		//Verify
		$citem = CustomItems::get($namespaceid);
		if (is_null($citem)){
			throw new RuntimeException(TextFormat::RED . "Unknow Custom Item namespace ID ! " . $namespaceid);
		}
		return $namespaceid;
	}

	/**
	 * @param Item $item
	 *
	 * @return string
	 * @throws RuntimeException
	 */
	public static function vanillaItemMapping(Item $item) : string{
		$item_aliases = StringToItemParser::getInstance()->lookupAliases($item);
		if (empty($item_aliases)){
			throw new RuntimeException("Item name not found ! " . $item->getVanillaName());
		}
		$item_name = $item_aliases[0]; //First one is the best one
		$nitem = StringToItemParser::getInstance()->parse($item_name);
		if (is_null($nitem)){
			//I haz no idea about this...
			throw new RuntimeException("Item name not found ! " . $item->getVanillaName() . "->" . $item_name);
		}
		if (!$item->canStackWith($nitem)){
			throw new RuntimeException("Parsed but cant stack with original " . $item->getVanillaName() . "->" . $item_name);
		}
		return $item_name;
	}

	public static function toItem(string $id): ?Item{
		$item = StringToItemParser::getInstance()->parse($id);
		if (!is_null($item)){
			return $item;
		}
		$citem = CustomItems::get($id);
		return $citem?->toItem();
	}

	/**
	 * @param Inventory $inv
	 * @param Item      $other
	 *
	 * @return int
	 *
	 * @description Return count of item in player inventory
	 */
	public static function getItemCount(Inventory $inv, Item $other): int{
		$count = 0;
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
				if($slot->equals($item, !$slot->hasAnyDamageValue())){
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
		$nbt = $item->nbtSerialize();
		return mb_convert_encoding(serialize($nbt), 'UTF-8');
	}

	public static function fromString(string $string): ?Item{
		try{
			return Item::nbtDeserialize(unserialize(mb_convert_encoding($string, 'ISO-8859-1')));
		}catch(Exception){
			return null;
		}
	}

	/**
	 * @param Item[] $items
	 *
	 * @return string[]
	 */
	public static function ItemArraytoStringArray(array $items): array{
		$data = [];
		foreach($items as $item){
			$data[] = self::toString($item);
		}
		return $data;
	}

	/**
	 * @param string[] $data
	 *
	 * @return Item[]
	 */
	public static function StringArrayToItemArray(array $data): array{
		$items = [];
		foreach($data as $d){
			$items[] = self::fromString($d);
		}
		return $items;
	}

	/**
	 * @param Item[] $items
	 *
	 * @return string
	 */
	public static function ItemArray2string(array $items): string{
		$data = [];
		foreach($items as $item){
			$data[] = $item->nbtSerialize();
		}
		return mb_convert_encoding(serialize($data), 'UTF-8');
	}

	/**
	 * @param string $data
	 *
	 * @return Item[]
	 */
	public static function string2ItemArray(string $data): array{
		if ($data == "") return [];
		$array = unserialize(mb_convert_encoding($data, 'ISO-8859-1'));
		$items = [];
		foreach($array as $nbt){
			$items[] = Item::nbtDeserialize($nbt);
		}
		return $items;
	}
}