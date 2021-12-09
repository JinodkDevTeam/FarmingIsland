<?php
declare(strict_types=1);

namespace PlayerStat;

use PlayerStat\listener\EventListener;
use PlayerStat\session\SessionManager;
use PlayerStat\task\RegenTask;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected static Loader $instance;
	protected SessionManager $sessionManager;

	public static function getInstance() : Loader{
		return self::$instance;
	}

	protected function onLoad() : void{
		self::$instance = $this;
	}

	protected function onEnable() : void{
		$this->sessionManager = new SessionManager();
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$this->getScheduler()->scheduleRepeatingTask(new RegenTask(), 20);
	}

	protected function onDisable() : void{
		//NO !
	}

	public function getSessionManager() : SessionManager{
		return $this->sessionManager;
	}
}
