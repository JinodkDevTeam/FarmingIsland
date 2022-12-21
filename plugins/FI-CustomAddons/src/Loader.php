<?php
declare(strict_types=1);

namespace CustomAddons;

use CustomAddons\customies\CustomiesBlockManager;
use CustomAddons\customies\CustomiesItemManager;
use CustomAddons\enchantment\CustomEnchantGlint;
use CustomAddons\enchantment\LureEnchantment;
use CustomAddons\listener\CustomItemListener;
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
		CustomiesBlockManager::register(); //Register Customies blocks
		CustomiesItemManager::register(); //Register Customies items
		$this->getServer()->getPluginManager()->registerEvents(new CustomItemListener(), $this);
		EnchantmentIdMap::getInstance()->register(100, new CustomEnchantGlint());
		EnchantmentIdMap::getInstance()->register(EnchantmentIds::LURE, new LureEnchantment());

		//to id test for vanilla items
		/*foreach(VanillaItems::getAll() as $item){
			try{
				$item_name = ItemUtils::toId($item);
				Server::getInstance()->getLogger()->info($item->getVanillaName() . "->" . $item_name);
			}catch(RuntimeException $e){
				Server::getInstance()->getLogger()->error($e->getMessage());
			}
		}*/
		//to id test for vanilla blocks
		/*foreach(VanillaBlocks::getAll() as $block){
			try{
				$item = $block->asItem();
				$item_name = ItemUtils::toId($item);
				Server::getInstance()->getLogger()->info($item->getVanillaName() . "->" . $item_name);
			}catch(RuntimeException $e){
				Server::getInstance()->getLogger()->error($e->getMessage());
			}
		}*/
	}
}