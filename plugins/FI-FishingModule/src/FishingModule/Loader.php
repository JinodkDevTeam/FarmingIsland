<?php

declare(strict_types=1);

namespace FishingModule;

use FishingModule\entity\FishingHook;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
	protected static $instance;
	/** @var FishingHook[] */
	public array $fishingHook = [];

	public static function getInstance() : Loader{
		return self::$instance;
	}

	public function getFishingHook(Player $player) : ?FishingHook{
		if(isset($this->fishingHook[$player->getName()])){
			return $this->fishingHook[$player->getName()];
		}
		return null;
	}

	public function setFishingHook(Player $player, ?FishingHook $fishingHook): void {
		$this->fishingHook[$player->getName()] = $fishingHook;
	}

	public function onLoad() : void {

		ItemFactory::getInstance()->register(new FishingRod(new ItemIdentifier(ItemIds::FISHING_ROD, 0), "Fishing Rod"), true);
		$closure = function(World $world, CompoundTag $nbt): FishingHook {
			return new FishingHook(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
		};
		EntityFactory::getInstance()->register(FishingHook::class, $closure, ["FishingHook", "minecraft:fishinghook"], EntityLegacyIds::FISHING_HOOK);
	}

	public function setFishingHook(Player $player, ?FishingHook $fishingHook) : void{
		$this->fishingHook[$player->getName()] = $fishingHook;
	}

	public function onEnable() : void{
		self::$instance = $this;
	}

}