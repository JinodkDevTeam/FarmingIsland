<?php
declare(strict_types=1);

namespace CustomAddons\customies\fish;

use customiesdevs\customies\item\component\FoodComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Food;
use pocketmine\item\ItemIdentifier;

abstract class CustomFish extends Food implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_NATURE, CreativeInventoryInfo::GROUP_RAW_FOOD);
		$this->initComponent($this->getTexture(), $creativeInfo);
		$this->addComponent(new MaxStackSizeComponent(64));
		$this->addComponent(new FoodComponent(false));
	}

	public function getTexture() : string{
		return "";
	}

	public function getFoodRestore() : int{
		return 2;
	}

	public function getSaturationRestore() : float{
		return 9.1;
	}
}