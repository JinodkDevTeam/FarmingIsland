<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use NgLamVN\GameHandle\Core;
use pocketmine\block\BlockLegacyIds;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\Server;

class Menu
{

    public const BAN_BLOCK = [
        BlockLegacyIds::CHEST,
		BlockLegacyIds::ENCHANTING_TABLE,
		BlockLegacyIds::CRAFTING_TABLE,
		BlockLegacyIds::FURNACE,
		BlockLegacyIds::ANVIL,
		BlockLegacyIds::WOODEN_DOOR_BLOCK,
		BlockLegacyIds::WOODEN_TRAPDOOR,
		BlockLegacyIds::IRON_DOOR_BLOCK,
		BlockLegacyIds::IRON_TRAPDOOR,
		BlockLegacyIds::TRAPPED_CHEST,
		BlockLegacyIds::ACACIA_TRAPDOOR,
		BlockLegacyIds::BIRCH_TRAPDOOR,
		BlockLegacyIds::DARK_OAK_TRAPDOOR
    ];

    public function __construct()
    {
    }

	public function getCore(): ?Core
	{
		$core = Server::getInstance()->getPluginManager()->getPlugin("FI-GameHandle");
		if ($core instanceof Core)
		{
			return $core;
		}
		return null;
	}

    public function registerMenuItem(Player $player)
    {
        if ($player->getInventory()->getHotbarSlotItem(8)->getNamedTag()->getTag("menu-mode") == null)
        {
            return;
        }
        $i = VanillaItems::PAPER();
        $nbt = $i->getNamedTag();
        $nbt->setByte("menu", 1);
        $nbt->setString("menu-mode", "ui");
        $i->setNamedTag($nbt);
        $i->setCustomName("Island Menu");
        $i->setLore(["Hold and tap to open menu !"]);
        $player->getInventory()->setItem(8, $i);
    }

    public function onTap(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();

        $slot = $player->getInventory()->getHeldItemIndex();

        if (in_array($event->getBlock()->getId(), self::BAN_BLOCK))
        {
            return;
        }

        if ($slot == 8)
        {
            if ($player->getInventory()->getItemInHand()->getNamedTag()->getTag("menu-mode")->getValue() == "gui")
            {
                new GuiMenu($player);
            }
            else{
                new UiMenu($player);
            }

        }
    }

    public function onDrop (PlayerDropItemEvent $event)
    {
        $item = $event->getItem();
        $nbt = $item->getNamedTag();
        if ($nbt->getTag("menu") !== null)
        {
            if ($nbt->getTag("menu")->getValue() == 1)
            {
                $event->cancel();
            }
        }
    }
    public function onTrans (InventoryTransactionEvent $event)
    {
        $trans = $event->getTransaction();
        $actions = $trans->getActions();
        foreach ($actions as $action)
        {
            $nbt = $action->getSourceItem()->getNamedTag();
            if ($nbt->getTag("menu") !== null)
            {
                if ($nbt->getTag("menu")->getValue() == 1)
                {
                    $event->cancel();
                }
            }
        }
    }
    public function sendUpdatesForm (Player $player)
    {
        return new UpdateInfo($player);
    }
}