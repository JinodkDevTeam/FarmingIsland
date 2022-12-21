<?php
declare(strict_types=1);

namespace CustomAddons\customies\icon;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

abstract class CustomIcon extends Item implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
		$this->initComponent($this->getTexture(), $creativeInfo);
		$this->addComponent(new MaxStackSizeComponent(64));
	}

	public function getTexture() : string{
		return "";
	}
}