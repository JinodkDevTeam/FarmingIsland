<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;

class GameBreaker extends CustomItem{

	public function toItem() : Item{
		$item = VanillaBlocks::TNT()->asItem();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7This item was given to a player\nwho have reported a game bug, error\nGood job !",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}