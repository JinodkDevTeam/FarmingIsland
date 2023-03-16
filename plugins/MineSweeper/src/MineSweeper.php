<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use NgLam2911\MineSweeper\command\MsArea;
use NgLam2911\MineSweeper\command\MsSettings;
use pocketmine\plugin\PluginBase;

class MineSweeper extends PluginBase{

	public static MineSweeper $instance;

	public static function getInstance() : MineSweeper{
		return self::$instance;
	}

	public function onLoad() : void{
		self::$instance = $this;
	}

	public function onEnable() : void{
		try{
			if(!PacketHooker::isRegistered()){
				PacketHooker::register($this);
			}
		}catch(HookAlreadyRegistered){
			//NOOP
		}
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$this->getServer()->getCommandMap()->register("msarea", new MsArea($this, "msarea", "MS Area"));
		$this->getServer()->getCommandMap()->register("mssettings", new MsSettings($this, "mssettings", "MS Settings"));
	}
}