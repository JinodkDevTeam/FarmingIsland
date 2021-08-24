<?php
declare(strict_types=1);

namespace AutionHouse;

use AutionHouse\provider\SqliteProvider;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected SqliteProvider $provider;

	public function onEnable(): void{
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();
	}

	public function onDisable(): void{
		$this->getProvider()->close();
	}

	public function getProvider(): SqliteProvider{
		return $this->provider;
	}
}
