<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class OpRod extends CustomRod{

	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable(true);
		}
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setInt("FishingSpeed", 90);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A powerful fishing rod make for OP player",
			"",
			"§r§6+90% §bfishing speed.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}