<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Durable;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class TreeCutter extends VeinMineTool{

	public function toItem() : Item{
		$item = VanillaItems::GOLDEN_AXE();
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), 10));
		$item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 10));
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7An axe for speedrunner ?",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function getBreakLimit() : int{
		return 150;
	}

	public function getBreakBlocks() : array{
		return [
			VanillaBlocks::OAK_LOG(),
			VanillaBlocks::SPRUCE_LOG(),
			VanillaBlocks::BIRCH_LOG(),
			VanillaBlocks::ACACIA_LOG(),
			VanillaBlocks::JUNGLE_LOG(),
			VanillaBlocks::DARK_OAK_LOG(),
			VanillaBlocks::OAK_LEAVES(),
			VanillaBlocks::SPRUCE_LEAVES(),
			VanillaBlocks::JUNGLE_LEAVES(),
			VanillaBlocks::DARK_OAK_LEAVES(),
			VanillaBlocks::BIRCH_LEAVES(),
			VanillaBlocks::ACACIA_LEAVES()
		];
	}
}