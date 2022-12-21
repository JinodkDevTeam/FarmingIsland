<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\Rarity;
use CustomAddons\item\utils\RarityHelper;
use pocketmine\item\Item;

class EnchantedItem extends CustomItem{

	protected Item $baseitem;

	public function __construct(CustomItemIdentifier $identifier, string $name, Rarity $rarity, Item $baseitem){
		$this->baseitem = $baseitem;
		parent::__construct($identifier, $name, $rarity);
	}

	public function toItem() : Item{
		$item = $this->getBaseItem();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function getBaseItem() : Item{
		return $this->baseitem;
	}
}
