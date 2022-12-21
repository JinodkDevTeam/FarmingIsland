<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use RuntimeException;

class AnnihilatorSword extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::STONE_SWORD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7The ultimate sword that made\nfrom §cGame Annihilator§7.\nHave The ultimate power of bug, \nerrors and crashes.",
			"",
			"§r§bAbility: §eThe §cGame Crasher",
			"§r§7Instant crash the server when click air",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onClickAir(PlayerItemUseEvent $event) : void{
		throw new RuntimeException("Crashed due to ability of Annihilator Sword !");
	}
}