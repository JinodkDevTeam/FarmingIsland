<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use CustomItems\Loader;
use FishingModule\event\FishingHookHookEvent;
use FishingModule\item\FishingRod;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;

class OpAutomationRod extends CustomRod{

	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		$item = $this->setEnchantGlint($item);
		if ($item instanceof Durable){
			$item->setUnbreakable(true);
		}
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setInt("FishingSpeed", 96);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A powerful automation fishing rod\nfor OP that use to testing automation\nfishing feature",
			"",
			"§r§bAbility: §fAutomation",
			"§r§7Auto catch items when fishing.",
			"",
			"§r§6+96% §bfishing speed.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onHook(FishingHookHookEvent $event) : void{
		$task = new ClosureTask(function() use ($event) : void{
			$item = $event->getEntity()->getInventory()->getItemInHand();
			if ($item instanceof FishingRod){
				$player = $event->getEntity();
				if ($player instanceof Player){
					$item->onClickAir($player, $player->getDirectionVector());
					$item->onClickAir($player, $player->getDirectionVector());
				}
			}
		});
		Loader::getInstance()->getScheduler()->scheduleDelayedTask($task, 5);
	}
}