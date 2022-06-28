<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod\auto;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class OpAutomationRod extends AutoRod{
	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setInt("FishingSpeed", 96);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A powerful automation fishing rod\nfor OP that use to testing automation\nfishing feature",
			"",
			"§r§bAbility: §fAutomation",
			"§r§7Auto catch items when fishing.",
			"",
			"§r§6+96% §bfishing speed.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}