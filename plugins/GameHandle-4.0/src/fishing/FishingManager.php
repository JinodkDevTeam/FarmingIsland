<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\fishing;

use CustomAddons\customies\CustomiesItems;
use CustomAddons\quality\ItemQuality;
use CustomAddons\quality\Quality;
use FishingModule\event\EntityFishEvent;
use JinodkDevTeam\utils\Rand;
use pocketmine\entity\Human;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class FishingManager{
	public const BASE_FISH_CAUGH_CHANCE = 40;
	public const BASE_FISH_QUALITY_INCREASE_CHANCE = 0;

	public const FISH_QUALITY_CHANCE = [
		70, //NORMAL
		26, //SILVER
		3, //GOLD
		1 //DIAMOND
	];

	protected LegacyFishingManager $legacy;
	/** @var Quality[] */
	protected array $quality_list = [];
	/** @var Item[] */
	protected array $fishes = [];

	public function __construct(){
		$this->legacy = new LegacyFishingManager();
		$this->quality_list = Rand::build_chance([
			Quality::NORMAL(),
			Quality::SILVER(),
			Quality::GOLD(),
			Quality::DIAMOND()
		], self::FISH_QUALITY_CHANCE);
		$this->fishes = [
			VanillaItems::RAW_FISH(),
			VanillaItems::RAW_SALMON(),
			VanillaItems::CLOWNFISH(),
			VanillaItems::PUFFERFISH(),
			CustomiesItems::ALBACORE(),
			CustomiesItems::ANCHOVY(),
			CustomiesItems::BLOBFISH(),
			CustomiesItems::BLUE_DISCUS(),
			CustomiesItems::BREAM(),
			CustomiesItems::BULLHEAD(),
			CustomiesItems::CARP(),
			CustomiesItems::CATFISH(),
			CustomiesItems::CHUB(),
			CustomiesItems::DORADO(),
			CustomiesItems::EEL(),
			CustomiesItems::FLOUNDER(),
			CustomiesItems::GHOSTFISH(),
			CustomiesItems::HALIBUT(),
			CustomiesItems::HERRING(),
			CustomiesItems::ICE_PIP(),
			CustomiesItems::LARGEMOUTH_BASS(),
			CustomiesItems::LAVA_EEL(),
			CustomiesItems::LINGCOD(),
			CustomiesItems::LIONFISH(),
			CustomiesItems::MIDNIGHT_CARP(),
			CustomiesItems::MIDNIGHT_SQUID(),
			CustomiesItems::MUTANT_CARP(),
			CustomiesItems::OCTOPUS(),
			CustomiesItems::PERCH(),
			CustomiesItems::PIKE(),
			CustomiesItems::RADIOACTIVE_CARP(),
			CustomiesItems::RAINBOW_TROUT(),
			CustomiesItems::RED_MULLET(),
			CustomiesItems::RED_SNAPPER(),
			CustomiesItems::SANDFISH(),
			CustomiesItems::SCORPION_CARP(),
			CustomiesItems::SEA_CUCUMBER(),
			CustomiesItems::SHAD(),
			CustomiesItems::SHARDINE(),
			CustomiesItems::SLIMEJACK(),
			CustomiesItems::SMALLMOUTH_BASS(),
			CustomiesItems::SPOOK_FISH(),
			CustomiesItems::SQUID(),
			CustomiesItems::STINGRAY(),
			CustomiesItems::STONEFISH(),
			CustomiesItems::STURGEON(),
			CustomiesItems::SUNFISH(),
			CustomiesItems::SUPER_CUCUMBER(),
			CustomiesItems::TIGER_TROUT(),
			CustomiesItems::TILAPIA(),
			CustomiesItems::TUNA(),
			CustomiesItems::VOID_SALMON(),
			CustomiesItems::WALLEYE(),
			CustomiesItems::WOODSKIP(),
		];
	}

	public function onFish(EntityFishEvent $event) : void{
		if ($event->getState() !== EntityFishEvent::STATE_CAUGHT_FISH){
			return;
		}
		$isFish = Rand::fastChance(self::BASE_FISH_CAUGH_CHANCE);
		if(!$isFish){
			$event->setItemResult($this->legacy->getRandomItems());
			return;
		}
		$fish = $this->fishes[array_rand($this->fishes)];
		$quality = $this->quality_list[array_rand($this->quality_list)];
		if (Rand::fastChance($this->getFishQualityIncreaseChance($event->getEntity()))){
			$quality = $quality->increaseQuality();
		}
		ItemQuality::setQuality($fish, $quality);
		$event->setItemResult([$fish]);
	}

	public function getFishQualityIncreaseChance(Human $player) : int{
		$item = $player->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("FishQualityIncrease") !== null){
			return $item->getNamedTag()->getTag("FishQualityIncrease")->getValue();
		}
		return self::BASE_FISH_QUALITY_INCREASE_CHANCE;
	}

}