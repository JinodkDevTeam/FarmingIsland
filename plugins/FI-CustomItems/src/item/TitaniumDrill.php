<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class TitaniumDrill extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::PRISMARINE_SHARD();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setString("basebreaktime", "TitaniumDrill");
		$item->setCustomName(RarityType::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityType::toString($this->getRarity())
		]);
		return $item;
	}
}