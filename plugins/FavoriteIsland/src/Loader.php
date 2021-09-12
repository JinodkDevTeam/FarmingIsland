<?php
declare(strict_types=1);

namespace FavoriteIslands;

use FavoriteIslands\command\FavIslandCommand;
use FavoriteIslands\provider\SqliteProvider;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected SqliteProvider $provider;

	protected function onEnable() : void{
		$this->provider = new SqliteProvider($this);
		$this->getProvider()->init();

		$this->getServer()->getCommandMap()->register("favislands", new FavIslandCommand($this, "favislands"));
	}

	protected function onDisable() : void{
		$this->getProvider()->close();
	}

	public function getProvider() : SqliteProvider{
		return $this->provider;
	}
}