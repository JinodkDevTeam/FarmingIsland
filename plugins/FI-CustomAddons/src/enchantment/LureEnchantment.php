<?php
declare(strict_types=1);

namespace CustomAddons\enchantment;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;
use pocketmine\lang\KnownTranslationFactory;
use pocketmine\lang\KnownTranslationKeys;

class LureEnchantment extends Enchantment{
	public function __construct(){
		parent::__construct(KnownTranslationFactory::enchantment_fishingSpeed(), Rarity::RARE, ItemFlags::FISHING_ROD, ItemFlags::FISHING_ROD, 3);
	}
}