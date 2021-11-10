<?php
declare(strict_types=1);

namespace CustomItems\item;

use Backpack\Loader;
use CustomItems\item\utils\RarityHelper;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\Server;

class BackpackSlot extends CustomItem{

	public function toItem() : Item{
		$item = ItemFactory::getInstance()->get(ItemIds::CHEST);
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
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