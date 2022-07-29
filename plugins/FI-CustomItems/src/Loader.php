<?php
declare(strict_types=1);

namespace CustomItems;

use CustomItems\custombreaktime\TitaniumDrillBreakTime;
use CustomItems\customies\CustomiesItemManager;
use CustomItems\enchantment\CustomEnchantGlint;
use CustomItems\enchantment\LureEnchantment;
use CustomItems\item\CustomItems;
use CustomItems\listener\CustomItemListener;
use NgLamVN\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected static Loader $instance;

	public static function getInstance() : Loader{
		return self::$instance;
	}

	public function onLoad() : void{
		self::$instance = $this;
	}

	public function onEnable() : void{
		CustomiesItemManager::register(); //Register Customies items
		$this->getServer()->getPluginManager()->registerEvents(new CustomItemListener(), $this);
		EnchantmentIdMap::getInstance()->register(100, new CustomEnchantGlint());
		EnchantmentIdMap::getInstance()->register(EnchantmentIds::LURE, new LureEnchantment());
		CustomBreakTimeAPI::register(new TitaniumDrillBreakTime("TitaniumDrill"));
	}
}