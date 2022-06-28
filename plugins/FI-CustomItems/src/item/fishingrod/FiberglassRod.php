<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class FiberglassRod extends CustomRod{
	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setInt("FishingSpeed", 10);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A fishing rod use fiberglass instead of normal string.",
			"",
			"§r§6+10% §bfishing speed.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}