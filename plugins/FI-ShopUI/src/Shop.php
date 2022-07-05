<?php
declare(strict_types=1);

namespace ShopUI;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use RuntimeException;

class Shop extends PluginBase{

	protected Config $shopConfig;
	protected array $shopData = [];
	/** @var Category[]|ShopItem[] */
	protected array $shop = [];

	public function onEnable() : void{
		$this->saveResource("shop.yml");
		$this->shopConfig = new Config($this->getDataFolder() . "shop.yml", Config::YAML);
		$this->shopData = $this->shopConfig->getAll();

		$this->parseData();
	}

	public function reloadShop() : void{
		$this->shopConfig->reload();
		$this->shopData = $this->shopConfig->getAll();
	}

	public function parseData() : void{
		foreach($this->shopData as $key => $value){
			$parsed = $this->rawParseData($key, $value);
			$this->shop[] = $parsed;
		}
	}

	public function rawParseData(string $key, array $value) : null|Category|ShopItem{
		$type = $value["type"];
		switch($type){
			case "category":
				$list = [];
				foreach($value["list"] as $key2 => $value2){
					$parsed = $this->rawParseData($key2, $value2);
					if (!is_null($parsed)){
						$list[] = $parsed;
					}
				}
				return new Category($key, $value["image"], $list);
			case "item":
				$itemName = $value["item"];
				/** @var Item $item */
				$item = StringToItemParser::getInstance()->parse($itemName);
				if (is_null($item)){
					throw new RuntimeException("Unknow item " . $itemName);
				}
				return new ShopItem($item, (float)$value["buy"], (float)$value["sell"], (string)$value["icon"]);
			default:
				return null;
		}
	}

	public function getShop() : array{
		return $this->shop;
	}

	public function onDisable() : void{
		//TODO: Implement
	}
}