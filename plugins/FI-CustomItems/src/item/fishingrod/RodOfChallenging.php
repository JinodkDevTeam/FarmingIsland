<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class RodOfChallenging extends CustomRod{
	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$nbt->setInt("FishingSpeed", 15);
		$nbt->setInt("FishQualityIncrease", 8);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§6+15% §bfishing speed.",
			"§r§6+8% §achance to catch higher quality fish.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}