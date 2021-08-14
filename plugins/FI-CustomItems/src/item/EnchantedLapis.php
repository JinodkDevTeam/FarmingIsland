<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class EnchantedLapis extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::LAPIS_LAZULI();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityType::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityType::toString($this->getRarity())
		]);
		return $item;
	}
}
