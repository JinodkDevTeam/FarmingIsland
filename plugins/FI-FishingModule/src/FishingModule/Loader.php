<?php

declare(strict_types=1);

namespace FishingModule;

use FishingModule\entity\FishingHook;
use FishingModule\item\FishingRod;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class Loader extends PluginBase {
	/** @var FishingHook[] */
	public array $fishingHook = [];
	protected static $instance;

	public function getFishingHook(Player $player): ?FishingHook {
		if (isset($this->fishingHook[$player->getName()])) {
			return $this->fishingHook[$player->getName()];
		}
		return null;
	}

	public function setFishingHook(Player $player, ?FishingHook $fishingHook): void {
		$this->fishingHook[$player->getName()] = $fishingHook;
	}

	/*public function onLoad() : void {

		ItemFactory::getInstance()->register(new FishingRod(new ItemIdentifier(ItemIds::FISHING_ROD, 0), "Fishing Rod"), true);
		$closure = function(World $world, CompoundTag $nbt): FishingHook {
			return new FishingHook(EntityDataHelper::parseLocation($nbt, $world), null, $nbt);
		};
		EntityFactory::getInstance()->register(FishingHook::class, $closure, ["Item", "minecraft:item"], EntityLegacyIds::FISHING_HOOK);
	}*/

	public function onEnable() : void{
		self::$instance = $this;
	}

	public static function getInstance(): Loader {
		return self::$instance;
	}

}