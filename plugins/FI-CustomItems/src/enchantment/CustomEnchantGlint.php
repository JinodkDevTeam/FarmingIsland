<?php
declare(strict_types=1);

namespace CustomItems\enchantment;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;

class CustomEnchantGlint extends Enchantment{
	public function __construct(){
		parent::__construct("enchantment.customitems.glint", Rarity::MYTHIC, ItemFlags::NONE, ItemFlags::ALL, 1);
	}
}