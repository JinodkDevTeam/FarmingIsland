<?php
declare(strict_types=1);

namespace CustomItems;

use CustomItems\item\CustomItemFactory;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	public function onEnable() : void{
		new CustomItemFactory();
	}
}