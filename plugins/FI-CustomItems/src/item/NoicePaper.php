<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class NoicePaper extends CustomItem{

	public function toItem() : Item{
		$item = ItemFactory::getInstance()->get(ItemIds::PAPER);
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityType::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"NOICE !",
			"Turn every clicked block into Diamond Block",
			RarityType::toString($this->getRarity())
		]);
		return $item;
	}

	public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : ItemUseResult{
		$blockClicked->getPos()->getWorld()->setBlock($blockClicked->getPos()->asVector3(), VanillaBlocks::DIAMOND());
		return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector);
	}
}
