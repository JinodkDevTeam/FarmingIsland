<?php
declare(strict_types=1);

namespace CustomAddons\item\fishingrod\auto;

use CustomAddons\item\utils\RarityHelper;
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
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$nbt->setInt("FishingSpeed", 96);
		$nbt->setInt("FishQualityIncrease", 100);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A powerful automation fishing rod\nfor OP that use to testing automation\nfishing feature",
			"",
			"§r§bAbility: §fAutomation",
			"§r§7Auto catch items when fishing.",
			"",
			"§r§6+96% §bfishing speed.",
			"§r§6+100% §achance to catch higher quality fish.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}