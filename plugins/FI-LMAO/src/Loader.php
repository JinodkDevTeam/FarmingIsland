<?php
declare(strict_types=1);

namespace LMAO;

use CortexPE\Commando\PacketHooker;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase{
	use SingletonTrait;

	protected Provider $provider;

	protected function onLoad() : void{
		self::setInstance($this);
	}

	public function onEnable() : void{
		if(!PacketHooker::isRegistered()) {
			PacketHooker::register($this);
		}

		$this->provider = new Provider($this);
	}

	public function onDisable() : void{
		//NO
	}

	public function getProvider() : Provider{
		return $this->provider;
	}
}