<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager;

use NgLam2911\PlayerDataManager\provider\SQLProvider;
use pocketmine\plugin\PluginBase;

class PDM extends PluginBase{

	protected SQLProvider $provider;

	protected function onEnable() : void{
		$this->saveResource("config.yml");
		$this->provider = new SQLProvider($this);
		$this->provider->load();
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
	}

	protected function onDisable() : void{
		$this->provider->unload();
	}

	public function getProvider() : SQLProvider{
		return $this->provider;
	}
}