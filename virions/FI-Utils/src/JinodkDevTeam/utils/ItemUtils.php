<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils;

use CustomAddons\item\CustomItems;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\NBT;
use pocketmine\nbt\NbtDataException;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\TreeRoot;
use pocketmine\utils\TextFormat;
use RuntimeException;

class ItemUtils{

	private static function isCIEnabled(): bool{
		//Make FI-CustomAddon optional
		return class_exists(CustomItems::class);
	}

	public static function toName(string $id): string{
		$item = StringToItemParser::getInstance()->parse($id);
		if (!is_null($item)){
			return $item->getName();
		}
		if (self::isCIEnabled()){
			$citem = CustomItems::get($id);
			return is_null($citem)?"":$citem->getName();
		}
		return "";
	}

	public static function toId(Item $item): string{
		if (self::isCIEnabled()){
			$nbt = $item->getNamedTag();
			if ($nbt->getTag("CustomItemID") !== null){
				$namespaceid = (string)$nbt->getTag("CustomItemID")->getValue();
				//Verify
				$citem = CustomItems::get($namespaceid);
				if (is_null($citem)){
					throw new RuntimeException(TextFormat::RED . "Unknow Custom Item namespace ID ! " . $namespaceid);
				}
				return $namespaceid;
			}
		}
		return self::vanillaItemMapping($item);
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
		if (self::isCIEnabled()){
			$citem = CustomItems::get($id);
			if (!is_null($citem)){
				return $citem->toItem();
			}
		}
		return null;
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

	public static function toBinaryString(Item $item): string{
		$nbt = $item->nbtSerialize();
		$writter = new LittleEndianNbtSerializer();
		return $writter->write(new TreeRoot($nbt));
	}

	public static function fromBinaryString(string $string): ?Item{
		$reader = new LittleEndianNbtSerializer();
		$root = $reader->read($string);
		try{
			$nbt = $root->mustGetCompoundTag();
		}catch(NbtDataException $exception){
			return null;
		}
		return Item::nbtDeserialize($nbt);
	}

	/**
	 * @param Item[] $items
	 *
	 * @return string
	 */
	public static function itemArray2binString(array $items): string{
		$contents = [];
		foreach($items as $item){
			$contents[] = $item->nbtSerialize();
		}
		$listTag = new ListTag($contents, NBT::TAG_Compound);
		$writter = new LittleEndianNbtSerializer();
		return $writter->write(new TreeRoot($listTag));
	}

	/**
	 * @param string $data
	 *
	 * @return Item[]
	 */
	public static function binString2itemArray(string $data): array{
		$contents = [];
		$reader = new LittleEndianNbtSerializer();
		$root = $reader->read($data);
		/** @var ListTag $listTag */
		$listTag = $root->getTag();
		if (!$listTag instanceof ListTag){
			return [];
		}
		if ($listTag->getTagType() !== NBT::TAG_Compound){
			return [];
		}
		/** @var CompoundTag $tag */
		foreach($listTag as $tag){
			$contents[] = Item::nbtDeserialize($tag);
		}
		return $contents;
	}
}