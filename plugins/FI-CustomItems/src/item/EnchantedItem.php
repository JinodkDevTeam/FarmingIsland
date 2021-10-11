<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\Item;
use CustomItems\item\utils\RarityType;

class EnchantedItem extends CustomItem{

	protected Item $baseitem;

	public function __construct(CustomItemIdentifier $identifier, string $name, int $rarity, Item $baseitem){
		$this->baseitem = $baseitem;
		parent::__construct($identifier, $name, $rarity);
	}

	public function toItem() : Item{
		$item = $this->getBaseItem();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityType::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityType::toString($this->getRarity())
		]);
		return $item;
	}

	public function getBaseItem() : Item{
		return $this->baseitem;
	}
}
