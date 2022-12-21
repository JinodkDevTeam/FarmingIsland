<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class Crook extends VeinMineTool{

	public function toItem() : Item{
		$item = VanillaItems::STICK();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A forceful stick which can\nbreak a large amount of leaves\nin a single hit.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function getBreakBlocks() : array{
		return [
			VanillaBlocks::OAK_LEAVES(),
			VanillaBlocks::SPRUCE_LEAVES(),
			VanillaBlocks::JUNGLE_LEAVES(),
			VanillaBlocks::DARK_OAK_LEAVES(),
			VanillaBlocks::BIRCH_LEAVES(),
			VanillaBlocks::ACACIA_LEAVES()
		];
	}
}