<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class TitaniumDrill extends CustomTool{

	public function toItem() : Item{
		$item = VanillaItems::PRISMARINE_SHARD();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setString("basebreaktime", "TitaniumDrill");
		$nbt->setInt("Fuel", 1000);
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityHelper::toString($this->getRarity()),
			"Fuel: 1000/1000"
		]);
		return $item;
	}

	public function onDestroyBlock(BlockBreakEvent $event) : void{
		$player = $event->getPlayer();
		$item = $player->getInventory()->getItemInHand();
		$nbt = $item->getNamedTag();
		$fuel = $nbt->getTag("Fuel")?->getValue();
		if ($fuel > 0){
			$fuel--;
			$nbt->setInt("Fuel", $fuel);
			$item->setNamedTag($nbt);
			$item->setLore([
				RarityHelper::toString($this->getRarity()),
				"Fuel: " . $fuel . "/1000"
			]);
			$player->getInventory()->setItemInHand($item);
			return;
		}
		$player->sendMessage("Fuel is not enough to use !");
		$event->cancel();
	}
}