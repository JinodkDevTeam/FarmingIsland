<?php
declare(strict_types=1);

namespace CustomStuff\block;

use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\VanillaItems;

class InferiumSeed implements Listener
{

    /**
     * @param BlockBreakEvent $event
     * @priority LOWEST
     * @ignoreCancelled TRUE
     */
    public function onBreak(BlockBreakEvent $event)
    {
        if ($event->getBlock()->getId() == BlockLegacyIds::BEETROOT_BLOCK)
        {
            $item = VanillaItems::BEETROOT_SEEDS();
            $item->setCustomName("§r§aInferium §fSeed");
            $nbt = $item->getNamedTag();
            $nbt->setString("CustomItem", "InferiumSeed");
            /*$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH, [], NBT::TAG_Compound));*/

            $event->setDrops([$item]);
        }
    }

    /**
     * @param PlayerInteractEvent $event
     * @priority HIGHEST
     * @handleCancelled FALSE
     */
    public function onInteract(PlayerInteractEvent $event)
    {
        if ($event->getAction() !== PlayerInteractEvent::RIGHT_CLICK_BLOCK)
        {
            return;
        }
        if ($event->getBlock()->getId() == BlockLegacyIds::BEETROOT_BLOCK)
        {
            if ($event->getBlock()->getMeta() == 7)
            {
                $event->getBlock()->getPosition()->getWorld()->setBlock($event->getBlock()->getPosition()->asVector3(), VanillaBlocks::BEETROOTS(), true);

                $item = VanillaItems::BEETROOT();
                $item->setCustomName("§r§aInferium §fEssence");
                $nbt = $item->getNamedTag();
                $nbt->setString("CustomItem", "InferiumEssence");
                /*$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH, [], NBT::TAG_Compound));*/

                $event->getBlock()->getPosition()->getWorld()->dropItem($event->getBlock()->getPosition()->asVector3(), $item);
                $event->cancel();
            }
        }
    }
}
