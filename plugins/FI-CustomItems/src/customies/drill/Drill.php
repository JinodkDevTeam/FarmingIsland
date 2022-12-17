<?php
declare(strict_types=1);

namespace CustomItems\customies\drill;

use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\component\RenderOffsetsComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use CustomItems\customies\CustomiesBlocks;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

abstract class Drill extends Item implements ItemComponents{
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
		$this->initComponent($this->getTexture(), $creativeInfo);
		$this->addComponent(new MaxStackSizeComponent(1));
		$diggerCompoment = new DiggerComponent();
		foreach(VanillaBlocks::getAll() as $block){
			$toolType = $block->getBreakInfo()->getToolType();
			$harvestLv = $block->getBreakInfo()->getToolHarvestLevel();
			if (($toolType == BlockToolType::PICKAXE) && ($harvestLv <= $this->getBlockToolHarvestLevel())){
				$diggerCompoment->withBlocks($this->getBaseMiningSpeed(), $block);
			}
		}
		foreach(CustomiesBlocks::getAll() as $block){
			$toolType = $block->getBreakInfo()->getToolType();
			$harvestLv = $block->getBreakInfo()->getToolHarvestLevel();
			if (($toolType == BlockToolType::PICKAXE) && ($harvestLv <= $this->getBlockToolHarvestLevel())){
				$diggerCompoment->withBlocks($this->getBaseMiningSpeed(), $block);
			}
		}
		$this->addComponent($diggerCompoment);
		$this->addComponent(new HandEquippedComponent(true));
		/*$this->addComponent(new DrillRenderOffsets());*/

	}

	public function getBaseMiningSpeed() : int{
		return 0;
	}

	public function getTexture() : string{
		return "";
	}

	public function getBlockToolType() : int{
		return BlockToolType::PICKAXE;
	}

	public function getMiningEfficiency(bool $isCorrectTool) : float{
		if($isCorrectTool){
			return $this->getBaseMiningSpeed();
		}
		return 1;
	}
}