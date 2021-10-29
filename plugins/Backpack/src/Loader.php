<?php
declare(strict_types=1);

namespace Backpack;

use Backpack\command\BackpackCommand;
use Backpack\provider\SqliteProvider;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use SOFe\AwaitGenerator\Await;

class Loader extends PluginBase{

	protected SqliteProvider $provider;

	protected function onEnable() : void{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();

		$this->getServer()->getCommandMap()->register("backpack", new BackpackCommand($this, "backpack"));
	}

	protected function onDisable() : void{
		$this->getProvider()->close();
	}

	public function getProvider() : SqliteProvider{
		return $this->provider;
	}

	public function addBackpackSlot(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield $this->getProvider()->selectPlayer($player);
			$this->getProvider()->register($player, count($data));
		});
	}
}