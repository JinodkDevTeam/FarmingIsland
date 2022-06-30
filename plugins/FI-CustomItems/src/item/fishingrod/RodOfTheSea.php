<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RodOfTheSea extends CustomRod{
	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setInt("FishingSpeed", 60);
		$nbt->setInt("FishQualityIncrease", 60);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A fishing rod has the ultimate power of the sea.",
			"",
			"§r§6+60% §bfishing speed.",
			"§r§6+60% §achance to catch higher quality fish.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}