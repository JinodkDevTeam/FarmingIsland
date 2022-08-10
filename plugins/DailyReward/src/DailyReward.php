<?php
declare(strict_types=1);

namespace Nglam2911\DailyReward;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class DailyReward extends PluginBase{
	use SingletonTrait;
	protected function onLoad() : void{
		self::setInstance($this);
	}

	/**
	 * @return DailyReward
	 * @overwrite SingletonTrait::getInstance()
	 */
	public static function getInstance() : DailyReward{
		return self::$instance;
	}

	protected function onEnable() : void{
		//TODO: Implement onEnable()
	}

	protected function onDisable() : void{
		//TODO: Implement onDisable()
	}
}