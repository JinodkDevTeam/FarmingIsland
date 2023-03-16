<?php
declare(strict_types=1);

namespace CustomAddons\customies\minesweeper;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class FlagItem extends Item implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Flag"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
		$this->initComponent($this->getTexture(), $creativeInfo);
		$this->addComponent(new MaxStackSizeComponent(1));
	}

	public function getTexture() : string{
		return "item_flag";
	}
}