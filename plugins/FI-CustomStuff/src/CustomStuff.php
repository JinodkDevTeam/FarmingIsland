<?php
declare(strict_types=1);

namespace CustomStuff;

use CustomStuff\block\__initBlock;
use CustomStuff\item\__init;
use pocketmine\plugin\PluginBase;

class CustomStuff extends PluginBase
{
    public function onEnable(): void
    {
        new __init($this);
        new __initBlock($this);

        /*$this->piggyCE = $this->getServer()->getPluginManager()->getPlugin("PiggyCustomEnchants");

        $edian = new BigEndianNBTStream();
        $item = Item::get(Item::IRON_CHESTPLATE);
        $item->setCustomName("§r§　§l§cNo §eU");
        $nbt = $item->getNamedTag();
        $nbt->setString("CustomItem", "NoUArmor");
        $nbt->setByte("Unbreakable", 1);
        $item->setNamedTag($nbt);
        /*$this->enchantItem($item, 5, "thorns");
        $item->setLore(["§r§fWhat cactus can do ? \n\n§f§lUnbreakable"]);*/
        /*$item->setNamedTagEntry(new ListTag(Item::TAG_ENCH, [], NBT::TAG_Compound));*/
        /*$data = bin2hex($edian->writeCompressed($item->nbtSerialize()));
        $this->getLogger()->info($data);*/
    }

    /*public function enchantItem(Item $item, int $level, $enchantment): void
    {
        if(is_string($enchantment)){
            $ench = Enchantment::getEnchantmentByName((string) $enchantment);
            if($this->piggyCE !== null && $ench === null){
                $ench = CustomEnchantManager::getEnchantmentByName((string) $enchantment);
            }
            if($this->piggyCE !== null && $ench instanceof CustomEnchantManager){
                $this->piggyCE->addEnchantment($item, $ench->getName(), (int) $level);
            }else{
                $item->addEnchantment(new EnchantmentInstance($ench, (int) $level));
            }
        }
        if(is_int($enchantment)){
            $ench = Enchantment::getEnchantment($enchantment);
            $item->addEnchantment(new EnchantmentInstance($ench, (int) $level));
        }
    }*/
}
