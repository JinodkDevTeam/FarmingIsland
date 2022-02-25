<?php

declare(strict_types=1);

namespace FishingModule;

use FishingModule\entity\FishingHook;
use FishingModule\item\FishingRod;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\entity\Human;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class Loader extends PluginBase{
	protected static Loader $instance;
	/** @var FishingHook[] */
	public array $fishingHook = [];

	public static function getInstance() : Loader{
		return self::$instance;
	}

	public function getFishingHook(Human $entity) : ?FishingHook{
		if(isset($this->fishingHook[$entity->getName()])){
			return $this->fishingHook[$entity->getName()];
		}
		return null;
	}

	public function setFishingHook(Human $entity, ?FishingHook $fishingHook) : void{
		$this->fishingHook[$entity->getName()] = $fishingHook;
	}

	public function onLoad() : void{
		self::$instance = $this;

		ItemFactory::getInstance()->register(new FishingRod(new ItemIdentifier(ItemIds::FISHING_ROD, 0), "Fishing Rod"), true);
		$closure = function(World $world, CompoundTag $nbt) : FishingHook{
			return new FishingHook(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
		};
		EntityFactory::getInstance()->register(FishingHook::class, $closure, ["FishingHook", "minecraft:fishinghook"], EntityLegacyIds::FISHING_HOOK);
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}

}