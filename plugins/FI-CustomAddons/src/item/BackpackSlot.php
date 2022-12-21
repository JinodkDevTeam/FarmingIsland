<?php
declare(strict_types=1);

namespace CustomAddons\item;

use Backpack\Loader;
use CustomAddons\item\utils\RarityHelper;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\Server;

class BackpackSlot extends CustomItem{

	public function toItem() : Item{
		$item = VanillaBlocks::CHEST()->asItem();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7Add 1 Backpack slot to your\nBackpack manager.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onClickAir(PlayerItemUseEvent $event) : void{
		$this->addBackpackSlot($event->getPlayer());
	}

	public function onPlace(BlockPlaceEvent $event) : void{
		$this->addBackpackSlot($event->getPlayer());
		parent::onPlace($event);
	}

	public function addBackpackSlot(Player $player){
		$backpack = Server::getInstance()->getPluginManager()->getPlugin("Backpack");
		if ($backpack instanceof Loader){
			$player->getInventory()->removeItem($this->toItem());
			$backpack->addBackpackSlot($player);
			$player->sendMessage("Added 1 Backpack slot to your Backpack manager, /backpack to use.");
		}
	}
}