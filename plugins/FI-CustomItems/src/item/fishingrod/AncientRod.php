<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class AncientRod extends CustomRod{
	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$nbt->setInt("FishingSpeed", 50);
		$nbt->setInt("FishQualityIncrease", 20);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7§kHIHOIIAOSJOIaidooijaldlasdkoasdfa§r",
			"",
			"§r§6+§k50§r§6% §bfishing speed.",
			"§r§6+§k20§r§6% §achance to catch higher quality fish.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}