<?php
declare(strict_types=1);

namespace PlayerStat;

use PlayerStat\entity\DamageTagEntity;
use PlayerStat\listener\EventListener;
use PlayerStat\session\SessionManager;
use PlayerStat\task\RegenTask;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

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
		EntityFactory::getInstance()->register(DamageTagEntity::class, function(World $world, CompoundTag $nbt) : DamageTagEntity{
			return new DamageTagEntity(EntityDataHelper::parseLocation($nbt, $world), "0", $nbt);
		}, ['DamageTag', 'minecraft:damagetag'], EntityLegacyIds::FALLING_BLOCK);

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
