<?php
declare(strict_types=1);

namespace CustomItems\item\armor;

use CustomItems\item\utils\RarityHelper;
use pocketmine\color\Color;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\sound\ExplodeSound;

class BoosterBoots extends CustomBoots{
	public function toItem() : Item{
		$item = VanillaItems::LEATHER_BOOTS()->setCustomColor(new Color(255, 0, 0));
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7Wanna go to the moon ?",
			"",
			"§r§bAbility: §cBooster §aJump",
			"§r§7Sneak to jump ultra high",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onSneak(PlayerToggleSneakEvent $event) : void{
		if ($event->isSneaking()){
			$pos = $event->getPlayer()->getPosition();
			$pos->getWorld()->addParticle($pos, new HugeExplodeParticle());
			$pos->getWorld()->addSound($pos, new ExplodeSound());
			$event->getPlayer()->setMotion(new Vector3(0, 10, 0));
		}
	}
}