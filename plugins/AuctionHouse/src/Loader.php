<?php
declare(strict_types=1);

namespace AuctionHouse;

use AuctionHouse\command\AuctionHouseCommand;
use AuctionHouse\provider\SqliteProvider;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected SqliteProvider $provider;

	public function onEnable(): void{
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();

		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}

		$this->getServer()->getCommandMap()->register("ah", new AuctionHouseCommand($this));
	}

	public function onDisable(): void{
		$this->getProvider()->close();
	}

	public function getProvider(): SqliteProvider{
		return $this->provider;
	}
}
