<?php
declare(strict_types=1);

namespace Backpack;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase{

	protected function onEnable() : void{
		parent::onEnable(); // TODO: Change the autogenerated stub

		$eng = new Config($this->getDataFolder() . "bundle.properties", Config::PROPERTIES);
		$vie = new Config($this->getDataFolder() . "bundle_vi.properties", Config::PROPERTIES);

		$data_eng = $eng->getAll();
		$data_vie = $vie->getAll();
		foreach(array_keys($data_eng) as $key){
			if (!isset($data_vie[$key])){
				echo "missing key: " . $key . PHP_EOL;
				$data_vie[$key] = $data_eng[$key];
			}
		}
		foreach(array_keys($data_vie) as $key){
			if (!isset($data_eng[$key])){
				echo "key haz been removed: " . $key . PHP_EOL;
			}
		}
		$vie->setAll($data_vie);
		$vie->save();
	}

	protected function onDisable() : void{
		parent::onDisable(); // TODO: Change the autogenerated stub
	}
}