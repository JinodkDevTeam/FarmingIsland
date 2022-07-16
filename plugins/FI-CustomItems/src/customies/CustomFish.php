<?php
declare(strict_types=1);

namespace CustomItems\customies;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\nbt\tag\CompoundTag;

abstract class CustomFish extends Item implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_RAW_FOOD);
		$this->initComponent($this->getTexture(), 64, $creativeInfo);
	}

	public function getTexture() : string{
		return "";
	}
}