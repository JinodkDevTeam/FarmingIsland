<?php
declare(strict_types=1);

namespace RandKB;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class RandomKnockback extends PluginBase implements Listener{

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param EntityDamageByEntityEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onCombat(EntityDamageByEntityEvent $event){
		$knockback = mt_rand(0, 100);
		$event->setKnockBack($knockback / 10);
	}
}