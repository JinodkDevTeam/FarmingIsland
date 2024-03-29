<?php
declare(strict_types=1);

namespace CustomAddons\item\armor;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\Lava;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class MagmaBoots extends CustomBoots{

	public function toItem() : Item{
		$item = VanillaItems::CHAINMAIL_BOOTS();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§bAbility: §6Magma §bWalker",
			"§r§7Turn lava into obsidian when walking over",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onMove(PlayerMoveEvent $event) : void{
		$player = $event->getPlayer();
		$world = $player->getWorld();
		if (!($world->getBlock($player->getPosition()->asVector3()) instanceof Lava)) {
			$radius = 3;
			for ($x = -$radius; $x <= $radius; $x++) {
				for ($z = -$radius; $z <= $radius; $z++) {
					$b = $world->getBlock($player->getPosition()->add($x, -1, $z));
					if ($world->getBlock($b->getPosition()->add(0, 1, 0))->getId() === BlockLegacyIds::AIR) {
						if ($b instanceof Lava && $b->getMeta() === 0) {
							//TODO: Reset the obsidian blocks
							$world->setBlock($b->getPosition()->asVector3(), VanillaBlocks::OBSIDIAN());
						}
					}
				}
			}
		}
	}
}