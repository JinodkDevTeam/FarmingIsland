<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils;

use pocketmine\item\Item;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\TreeRoot;
use pocketmine\player\Player;

class Utils{

	public static function inventorySerializer(Player $player) : string{
		$inventory = $player->getInventory();
		$armorInventory = $player->getArmorInventory();
		//NOT ENDERCHEST PLS
		$items = [];
		foreach($inventory->getContents() as $slot => $item){
			$items[$slot] = $item->nbtSerialize($slot);
		}
		$invTag = new ListTag($items, NBT::TAG_Compound);
		$items = [];
		foreach($armorInventory->getContents() as $slot => $item){
			$items[$slot] = $item->nbtSerialize($slot);
		}
		$armorTag = new ListTag($items, NBT::TAG_Compound);
		$saveTag = new CompoundTag();
		$saveTag->setTag("inventory", $invTag);
		$saveTag->setTag("armor", $armorTag);

		$writer = new LittleEndianNbtSerializer();
		return $writer->write(new TreeRoot($saveTag));
	}

	public static function inventoryDeserialier(string $contents) : CompoundTag{
		$reader = new LittleEndianNbtSerializer();
		$root = $reader->read($contents);
		return $root->mustGetCompoundTag();
	}

	public static function inventorySetter(Player $player, CompoundTag $data) : void{
		$inventoryData = $data->getListTag("inventory");
		$armorData = $data->getListTag("armor");
		$inventory = $player->getInventory();
		$armorInventory = $player->getArmorInventory();
		foreach($inventoryData as $slot => $item){
			$inventory->setItem($slot, Item::nbtDeserialize($item));
		}
		foreach($armorData as $slot => $item){
			$armorInventory->setItem($slot, Item::nbtDeserialize($item));
		}
	}
}