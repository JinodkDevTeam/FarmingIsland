<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\block\Air;
use pocketmine\block\Liquid;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\world\sound\EndermanTeleportSound;

class AspectOfTheEnd extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::DIAMOND_SWORD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§bAbility: §6Instant §dTransmission",
			"§r§7Teleport 8 blocks ahead of you",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onClickAir(PlayerItemUseEvent $event) : void{
		$this->teleport($event->getPlayer());
	}

	public function onInteractBlock(PlayerInteractEvent $event) : void{
		if ($event->getAction() == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			$this->teleport($event->getPlayer());
		}
	}

	public function teleport(Player $player){
		$direction = $player->getDirectionVector();
		$pos = $player->getPosition();
		$world = $player->getWorld();
		$blocked = false;
		for($i = 1; $i <= 8; $i++){
			$pos = $pos->addVector($direction);

			if((!$world->getBlock($pos) instanceof Air) and (!$world->getBlock($pos) instanceof Liquid)){
				$pos = $pos->subtractVector($direction);
				$blocked = true;
				break;
			}
		}
		if ($blocked){
			$player->sendMessage("§r§7There are blocks in the way!");
		}
		$player->teleport($pos);
		$world->addSound($pos, new EndermanTeleportSound(), [$player]);
	}
}