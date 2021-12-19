<?php
declare(strict_types=1);

namespace LMAO;

use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected Provider $provider;

	public function onEnable() : void{
		$this->provider = new Provider($this);
	}

	public function onDisable() : void{
		//NO
	}

	public function getProvider() : Provider{
		return $this->provider;
	}
}