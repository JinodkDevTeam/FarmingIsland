<?php
declare(strict_types=1);

namespace CropsQuality;

use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;

class CropQuality extends PluginBase{

	public function onEnable() : void{
		//TODO: Implement onEnable() method.
	}

	public function onDisable() : void{
		//TODO: Implement onDisable() method.
	}

	public static function getQuality(Item $item) : ?Quality{
		$nbt = $item->getNamedTag();
		$tag = $nbt->getTag("quality");
		if(!is_null($tag)){
			return Quality::fromId($tag->getValue());
		}
		return null;
	}

	public static function setQuality(Item $item, Quality $quality) : void{
		$nbt = $item->getNamedTag();
		$nbt->setInt("quality", $quality->getId());
		$item->setNamedTag($nbt);
		$item->setCustomName($quality->getColor() . $item->getName());
	}

}