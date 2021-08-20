<?php
declare(strict_types=1);

namespace Mail;

use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	private SqliteProvider $provider;

	public function onEnable() : void{
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();

		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
	}

	public function onDisable() : void{
		$this->getProvider()->close();
	}

	public function getProvider(): SqliteProvider{
		return $this->provider;
	}

}