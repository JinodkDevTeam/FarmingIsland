<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager;

use JinodkDevTeam\utils\php\AutoGen\LibasynqlHelperAutoGen;
use NgLam2911\PlayerDataManager\provider\SQLProvider;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class PDM extends PluginBase{
	use SingletonTrait;

	protected SQLProvider $provider;

	public function onLoad() : void{
		self::setInstance($this);
	}

	protected function onEnable() : void{
		$this->saveResource("config.yml");
		$this->provider = new SQLProvider($this);
		$this->provider->load();
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

		/*LibasynqlHelperAutoGen::generateHelperFiles(
			$this,
			"plugins/PlayerDataManager/src/provider/",
			"sqlite.sql",
			"NgLam2911\\PlayerDataManager\\provider",
			true
		);*/
	}

	protected function onDisable() : void{
		$this->provider->unload();
	}

	public function getProvider() : SQLProvider{
		return $this->provider;
	}
}