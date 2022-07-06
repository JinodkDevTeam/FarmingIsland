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

class SlimeBoots extends CustomBoots{
	/** @var int[] */
	protected array $sneak_time = [];

	public function toItem() : Item{
		$item = VanillaItems::LEATHER_BOOTS()->setCustomColor(new Color(0, 255, 0));
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7Made from pure slimes. Have the true power of slimes",
			"",
			"§r§bAbility: §aBouncing §bSlime",
			"§r§7The longer you sneak, the higher you can jump.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onSneak(PlayerToggleSneakEvent $event) : void{
		$player = $event->getPlayer();
		if ($event->isSneaking()){
			$this->sneak_time[$player->getName()] = time();
			return;
		}
		if (isset($this->sneak_time[$player->getName()])){
			$time = time() - $this->sneak_time[$player->getName()];
			$power = $time / 10;
			if ($power > 10){
				$power = 10; //Prevent laggs
			}
			if ($power >= 5){
				$pos = $event->getPlayer()->getPosition();
				$pos->getWorld()->addParticle($pos, new HugeExplodeParticle());
				$pos->getWorld()->addSound($pos, new ExplodeSound());
			}
			$player->setMotion((new Vector3(0, 1, 0))->multiply($power));
			unset($this->sneak_time[$player->getName()]);
		}
	}
}