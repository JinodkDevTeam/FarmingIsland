<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle;

use FishingModule\event\PlayerFishEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\SingletonTrait;

class FishingManager{
	use SingletonTrait;

	public const R1 = [0, 0, 10, 20, 20, 40, 10];
	public const R2 = [0, 10, 25, 20, 20, 20, 5];
	public const R3 = [0, 20, 30, 20, 20, 7, 3];
	public const R4 = [5, 30, 30, 20, 10, 4, 1];
	public const R5 = [10, 40, 30, 10, 5, 5, 0];
	public const R6 = [15, 40, 20, 10, 5, 0, 0];
	public const R7 = [90, 10, 0, 0, 0, 0, 0];
	public const R8 = [99, 1, 0, 0, 0, 0, 0];

	public const MAX_LEVEL = 8;

	public const RARE_LEVEL = [self::R1, self::R2, self::R3, self::R4, self::R5, self::R6, self::R7, self::R8];

	public const MORE_ITEMS = [100, 50, 50, 25, 25, 10];

	public const COUNT = [0, 1, 2, 3, 4, 5, 10];

	/** @var Item[] */
	public array $items = [];
	/** @var int[] */
	public array $rlevel = [];
	/** @var int[] */
	public array $multiply = [];
	/** @var array[] */
	public array $more_items = [];
	/** @var int[] */
	public array $customItem_rlevel = [];

	public function __construct(){
		$item = VanillaItems::IRON_NUGGET();
		$item->setCustomName("§r§bLazy §fShard");
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItem", "LazyShard");
		$item->setNamedTag($nbt);

		$item2 = VanillaItems::BEETROOT_SEEDS();
		$item2->setCustomName("§r§aInferium §fSeed");
		$nbt = $item2->getNamedTag();
		$nbt->setString("CustomItem", "InferiumSeed");
		/*$item2->setNamedTagEntry(new ListTag(Item::TAG_ENCH, [], NBT::TAG_Compound));*/

		$this->items = [
			ItemFactory::getInstance()->get(ItemIds::COBBLESTONE),
			ItemFactory::getInstance()->get(ItemIds::DIRT),
			ItemFactory::getInstance()->get(ItemIds::COAL),
			ItemFactory::getInstance()->get(ItemIds::IRON_INGOT),
			ItemFactory::getInstance()->get(ItemIds::FISH),
			ItemFactory::getInstance()->get(ItemIds::GOLD_INGOT),
			ItemFactory::getInstance()->get(ItemIds::LOG),
			ItemFactory::getInstance()->get(ItemIds::SAND),
			ItemFactory::getInstance()->get(ItemIds::CARROT),
			ItemFactory::getInstance()->get(ItemIds::BONE),
			ItemFactory::getInstance()->get(ItemIds::SALMON),
			ItemFactory::getInstance()->get(ItemIds::ROTTEN_FLESH),
			ItemFactory::getInstance()->get(ItemIds::DIAMOND),
			ItemFactory::getInstance()->get(ItemIds::POTATO),
			ItemFactory::getInstance()->get(ItemIds::CACTUS),
			ItemFactory::getInstance()->get(ItemIds::SUGARCANE),
			ItemFactory::getInstance()->get(ItemIds::EMERALD),
			$item,
			$item2
		];
		$this->rlevel = [
			ItemIds::COBBLESTONE => 1,
			ItemIds::DIRT => 2,
			ItemIds::COAL => 3,
			ItemIds::IRON_INGOT => 3,
			ItemIds::FISH => 2,
			ItemIds::GOLD_INGOT => 4,
			ItemIds::LOG => 2,
			ItemIds::SAND => 2,
			ItemIds::CARROT => 2,
			ItemIds::BONE => 2,
			ItemIds::SALMON => 2,
			ItemIds::ROTTEN_FLESH => 2,
			ItemIds::DIAMOND => 6,
			ItemIds::POTATO => 2,
			ItemIds::CACTUS => 3,
			ItemIds::SUGARCANE => 2,
			ItemIds::EMERALD => 5
		];

		$this->customItem_rlevel = [
			"LazyShard" => 8,
			"InferiumSeed" => 7
		];

		$this->build();
	}

	public function build(){
		//TODO: Build Multiply items
		for($i = 0; $i <= (self::MAX_LEVEL - 1); $i++){
			$test = [];
			for($j = 0; $j <= 6; $j++){
				$chance = self::RARE_LEVEL[$i][$j];
				if($chance > 0){
					for($k = 0; $k < $chance; $k++){
						array_push($test, self::COUNT[$j]);
					}
				}
			}
			shuffle($test);
			$this->multiply[$i] = $test;
		}
		//TODO: Build Chance For More Items

		for($i = 0; $i < 6; $i++){
			$test = [];
			$chance = self::MORE_ITEMS[$i];
			for($j = 0; $j < $chance; $j++){
				array_push($test, true);
			}
			for($j = 0; $j < (100 - $chance); $j++){
				array_push($test, false);
			}
			shuffle($test);
			$this->more_items[$i] = $test;
		}
	}

	public function onFish(PlayerFishEvent $event){
		if($event->getState() == PlayerFishEvent::STATE_CAUGHT_FISH){
			$event->setItemResult($this->getRandomItems());
		}
	}

	/**
	 * @return Item[]
	 */
	public function getRandomItems() : array{
		$i = 0;
		$more = true;
		$items = [];
		while($more == true){
			$item = $this->items[array_rand($this->items)];
			if($item->getNamedTag()->getTag("CustomItem") !== null){
				$level = $this->customItem_rlevel[$item->getNamedTag()->getTag("CustomItem")->getValue()];
			}else{
				$level = $this->rlevel[$item->getId()];
			}
			$item->setCount($this->multiply[$level - 1][array_rand((array) $this->multiply[$level - 1])]);
			if($item->getCount() > 0){
				array_push($items, $item);
			}
			$i++;
			if($i <= 5){
				$more = $this->more_items[$i][array_rand($this->more_items[$i])];
			}else{
				$more = $this->more_items[5][array_rand($this->more_items[5])];
			}
		}
		return $items;
	}
}