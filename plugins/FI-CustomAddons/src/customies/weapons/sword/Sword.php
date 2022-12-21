<?php
declare(strict_types=1);

namespace CustomAddons\customies\weapons\sword;

use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

abstract class Sword extends Item implements ItemComponents {
	use ItemComponentsTrait;

	public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
		parent::__construct($identifier, $name);
		$creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
		$this->initComponent($this->getTexture(), $creativeInfo);
		$diggerComponent = new DiggerComponent();
		$diggerComponent->withBlocks($this->getBaseMiningSpeed(), VanillaBlocks::BAMBOO(), VanillaBlocks::COBWEB());
		$this->addComponent($diggerComponent);
		$this->addComponent(new HandEquippedComponent(true));
		$this->addAdditionalComponent();
	}

	public function getTexture() : string{
		return "";
	}

	public function addAdditionalComponent() : void{
	}

	public function getBaseMiningSpeed() : int{
		return 10;
	}

	public function getBaseDamage() : int{
		return 0;
	}

	/** PM FUNCTION */

	public function getBlockToolType() : int{
		return BlockToolType::SWORD;
	}

	public function getBlockToolHarvestLevel() : int{
		return 1;
	}

	public function getMiningEfficiency(bool $isCorrectTool) : float{
		if ($isCorrectTool){
			return $this->getBaseMiningSpeed();
		}
		return parent::getMiningEfficiency(false);
	}

	public function getAttackPoints() : int{
		return $this->getBaseDamage();
	}
}