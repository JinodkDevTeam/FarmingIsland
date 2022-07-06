<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\fishing;

use CustomItems\quality\ItemQuality;
use CustomItems\quality\Quality;
use FishingModule\event\EntityFishEvent;
use JinodkDevTeam\utils\Rand;
use pocketmine\entity\Human;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class FishingManager{
	public const BASE_FISH_CAUGH_CHANCE = 40;
	public const BASE_FISH_QUALITY_INCREASE_CHANCE = 0;

	public const FISHS = [
		ItemIds::FISH,
		ItemIds::SALMON,
		ItemIds::CLOWNFISH,
		ItemIds::PUFFERFISH
		//TODO: Implement more custom fishs.
	];

	public const FISH_QUALITY_CHANCE = [
		70, //NORMAL
		26, //SILVER
		3, //GOLD
		1 //DIAMOND
	];

	protected LegacyFishingManager $legacy;
	/** @var Quality[] */
	protected array $quality_list = [];

	public function __construct(){
		$this->legacy = new LegacyFishingManager();
		$this->quality_list = Rand::build_chance([
			Quality::NORMAL(),
			Quality::SILVER(),
			Quality::GOLD(),
			Quality::DIAMOND()
		], self::FISH_QUALITY_CHANCE);
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
		$fish = ItemFactory::getInstance()->get(self::FISHS[array_rand(self::FISHS)], 0, 1);
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