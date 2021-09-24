<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class TitaniumDrill extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::PRISMARINE_SHARD();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$nbt->setString("basebreaktime", "TitaniumDrill");
		$nbt->setInt("Fuel", 1000);
		$item->setCustomName(RarityType::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityType::toString($this->getRarity()),
			"Fuel: 1000/1000"
		]);
		return $item;
	}

	public function onDestroyBlock(Player $player, Block $block) : ItemUseResult{
		$item = $player->getInventory()->getItemInHand();
		$nbt = $item->getNamedTag();
		$fuel = $nbt->getTag("Fuel")?->getValue();
		if ($fuel > 0){
			$fuel--;
			$nbt->setInt("Fuel", $fuel);
			$item->setNamedTag($nbt);
			$item->setLore([
				RarityType::toString($this->getRarity()),
				"Fuel: " . $fuel . "/1000"
			]);
			$player->getInventory()->setItemInHand($item);
			return ItemUseResult::SUCCESS();
		}
		$player->sendMessage("Fuel is not enough to use !");
		return ItemUseResult::FAIL();
	}
}