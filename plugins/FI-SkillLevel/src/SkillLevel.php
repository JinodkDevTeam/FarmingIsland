<?php
declare(strict_types=1);

namespace SkillLevel;

use Exception;
use pocketmine\plugin\PluginBase;
use SkillLevel\provider\Sqlite3Provider;

class SkillLevel extends PluginBase{
	private PlayerSkillLevelManager $manager;
	private Sqlite3Provider $provider;

	public function onEnable() : void{
		$this->saveDefaultConfig();
		$this->provider = new Sqlite3Provider($this);
		try{
			$this->getProvider()->register();
		}catch(Exception){
			$this->getLogger()->info("Failed to load database, disable this plugin ...");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->manager = new PlayerSkillLevelManager();
	}

	public function getProvider() : Sqlite3Provider{
		return $this->provider;
	}

	public function onDisable() : void{
		$this->getProvider()->save();
	}

	public function getPlayerSkillLevelManager() : PlayerSkillLevelManager{
		return $this->manager;
	}
}
