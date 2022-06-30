<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\fishing;

use JinodkDevTeam\utils\Rand;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\SingletonTrait;

class LegacyFishingManager{
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

	public function __construct(){
		$this->items = [
			VanillaBlocks::COBBLESTONE()->asItem(),
			VanillaBlocks::DIRT()->asItem(),
			VanillaItems::COAL(),
			VanillaItems::IRON_INGOT(),
			VanillaItems::GOLD_INGOT(),
			VanillaBlocks::OAK_LOG()->asItem(),
			VanillaBlocks::SAND()->asItem(),
			VanillaItems::CARROT(),
			VanillaItems::BONE(),
			VanillaItems::ROTTEN_FLESH(),
			VanillaItems::DIAMOND(),
			VanillaItems::POTATO(),
			VanillaBlocks::CACTUS()->asItem(),
			VanillaBlocks::SUGARCANE()->asItem(),
			VanillaItems::EMERALD()
		];
		$this->rlevel = [
			ItemIds::COBBLESTONE => 1,
			ItemIds::DIRT => 2,
			ItemIds::COAL => 3,
			ItemIds::IRON_INGOT => 3,
			ItemIds::GOLD_INGOT => 4,
			ItemIds::LOG => 2,
			ItemIds::SAND => 2,
			ItemIds::CARROT => 2,
			ItemIds::BONE => 2,
			ItemIds::ROTTEN_FLESH => 2,
			ItemIds::DIAMOND => 6,
			ItemIds::POTATO => 2,
			ItemIds::CACTUS => 3,
			ItemIds::SUGARCANE => 2,
			ItemIds::EMERALD => 5
		];

		$this->build();
	}

	public function build() : void{
		//Build Multiply items
		for($i = 0; $i <= (self::MAX_LEVEL - 1); $i++){
			$list = Rand::build_chance(self::COUNT, self::RARE_LEVEL[$i]);
			$this->multiply[$i] = $list;
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
			$level = $this->rlevel[$item->getId()];
			$item = $item->setCount($this->multiply[$level - 1][array_rand((array) $this->multiply[$level - 1])]);
			if(!$item->isNull()){
				$items[] = $item;
				$i++;
			}
			if($i <= 5){
				$more = Rand::fastChance(self::MORE_ITEMS[$i]);
			}else{
				$more = Rand::fastChance(self::MORE_ITEMS[5]);
			}
		}
		return $items;
	}
}