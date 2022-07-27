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
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$nbt->setInt("FishingSpeed", 10);
		$nbt->setInt("FishQualityIncrease", 70);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A fishing rod use fiberglass instead of normal string.",
			"",
			"§r§6+10% §bfishing speed.",
			"§r§6+70% §achance to catch higher quality fish.",
			"§r§6+0.1% §ethe cable being attacked by a shark",
			"§r§6+0.01% §cthe whole fishing rod being yanked from your hand by a shark",
			"§r§o§7blame the shark for eating your fiber cable tho",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}