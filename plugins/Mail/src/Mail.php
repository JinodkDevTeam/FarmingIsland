<?php
declare(strict_types=1);

namespace Mail;

use pocketmine\plugin\PluginBase;

class Mail extends PluginBase{

	private SqliteProvider $provider;

	public function onEnable() : void{
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();
	}

	public function onDisable() : void{
		$this->getProvider()->close();
	}

	public function getProvider(): SqliteProvider{
		return $this->provider;
	}

}