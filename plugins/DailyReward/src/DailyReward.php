<?php
declare(strict_types=1);

namespace Nglam2911\DailyReward;

use NgLam2911\DailyReward\provider\SqliteProvider;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use NgLam2911\DailyReward\DailyRewardCommand as DLCommand;

class DailyReward extends PluginBase{
	use SingletonTrait;

	const COOLDOWN = 75600;
	const MISSTIME = 172800;

	protected SqliteProvider $provider;

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
		$this->provider = new SqliteProvider();
		$this->provider->init();
		$this->getServer()->getCommandMap()->register("dailyreward", new DLCommand($this, "dailyreward", "Daily reward system", []));
	}

	protected function onDisable() : void{
		$this->provider->close();
	}

	public function getProvider() : SqliteProvider{
		return $this->provider;
	}
}