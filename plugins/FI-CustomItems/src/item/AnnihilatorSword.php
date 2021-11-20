<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use RuntimeException;

class AnnihilatorSword extends CustomItem{

	public function toItem() : Item{
		$item = ItemFactory::getInstance()->get(ItemIds::STONE_SWORD);
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7The ultimate sword that made\nfrom §cGame Annihilator§7.\nHave The ultimate power of bug, \nerrors and crashes.",
			"",
			"§r§bAbility: §eThe §cGame Crasher",
			"§r§7Instance crash the server when click air",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onClickAir(PlayerItemUseEvent $event) : void{
		throw new RuntimeException("Crashed due to ability of Annihilator Sword !");
	}
}