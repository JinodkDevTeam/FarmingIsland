<?php

namespace CLADevs\VanillaX\enchantments\tools;

use CLADevs\VanillaX\enchantments\utils\EnchantmentTrait;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;
use pocketmine\item\Item;
use pocketmine\item\Tool;

class EfficiencyEnchantment extends Enchantment{
    use EnchantmentTrait;

    public function __construct(){
        parent::__construct(EnchantmentIds::EFFICIENCY, "%enchantment.digging", Rarity::COMMON, ItemFlags::DIG, ItemFlags::SHEARS, 5);
    }

    public function isItemCompatible(Item $item): bool{
        return $item instanceof Tool;
    }
}