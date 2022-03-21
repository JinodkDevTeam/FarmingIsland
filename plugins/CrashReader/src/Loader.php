<?php
declare(strict_types=1);

namespace CrashReader;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected function onEnable() : void{
		try{
			if(!PacketHooker::isRegistered()){
				PacketHooker::register($this);
			}
		}catch(HookAlreadyRegistered){
			//NOOP
		}
		$this->getServer()->getCommandMap()->register("crashreader", new CrashReaderCommand($this, "crashreader", "Crash reader command"));
	}
}