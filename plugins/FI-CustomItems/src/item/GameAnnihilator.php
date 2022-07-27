<?php

declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class GameAnnihilator extends CustomItem{

	public function toItem() : Item{
		$item = ItemFactory::getInstance()->get(ItemIds::END_CRYSTAL); //Will changes in pm5, since pm4 doesnt have any end crystal constant
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7This item was being given to a player\nwho have reported a bug that effect the whole\ngame, may make the server devs cry.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}
}