<?php
declare(strict_types=1);

namespace PlayerStat\listener;

use PlayerStat\Loader;
use PlayerStat\session\PlayerSession;
use PlayerStat\utils\ChanceCaculator;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\player\Player;

class EventListener implements Listener{

	/**
	 * @param EntityDamageEvent $event
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 *
	 * @return void
	 */
	public function onDamage(EntityDamageEvent $event) : void{
		if ($event instanceof EntityDamageByEntityEvent){
			$damager = $event->getDamager();
			if ($damager instanceof Player){
				$stat = Loader::getInstance()->getSessionManager()->get($damager);
				if ($stat !== null){
					//Strength
					$multiply = 1 + $stat->getStrength()/100;
					$event->setBaseDamage($event->getBaseDamage()*$multiply);
					//Crit
					$crit = ChanceCaculator::chance((int)$stat->getCritChance());
					if ($crit){
						$multiply = 1 + $stat->getCritDamage();
						$event->setBaseDamage($event->getBaseDamage() * $multiply);
					}
					//Ferocity
					$multiply = 1 + (int)($stat->getFerocity() / 100);
					if (ChanceCaculator::chance((int)($stat->getFerocity() - $multiply*100))){
						$multiply++;
					}
					$event->setBaseDamage($event->getBaseDamage()*$multiply);
					//Attack speed
					$cooldown = $event->getAttackCooldown();
					$decrease = (int)($cooldown*($stat->getAttackSpeed()/200));
					$event->setAttackCooldown($cooldown - $decrease);
					//Knockback
					$knockback = $event->getKnockBack() * (1 + $stat->getKnockback()/100);
					$event->setKnockBack($knockback);
				}
			}
		}
		$victim = $event->getEntity();
		if ($victim instanceof Player){
			$stat = Loader::getInstance()->getSessionManager()->get($victim);
			if ($stat !== null){
				$defense = $event->getBaseDamage()*($stat->getDefense()/($stat->getDefense() + 100));
				$event->setBaseDamage($event->getBaseDamage() - $defense);

				$stat->setHealth($stat->getHealth() - $event->getFinalDamage());
				if ($stat->getHealth() <= 0){
					$victim->kill();
				}
				//Set damage to 0
				$event->setBaseDamage(0);
				foreach(array_keys($event->getModifiers()) as $key){
					$event->setModifier(0, $key);
				}
				//Knockback
				if ($event instanceof EntityDamageByEntityEvent){
					if ($stat->getKnockbackResistance() == -1){
						$event->setKnockBack(0);
					} else {
						$knockback_resistance = $event->getKnockBack()*($stat->getKnockbackResistance()/($stat->getKnockbackResistance() + 100));
						$event->setKnockBack($event->getKnockBack() - $knockback_resistance);
					}
				}
			}
		}
	}

	/**
	 * @param PlayerJoinEvent $event
	 * @priority HIGHEST
	 *
	 * @return void
	 */
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$stat = new PlayerSession($player);
		Loader::getInstance()->getSessionManager()->register($stat);
	}

	public function onRespawn(PlayerRespawnEvent $event){
		$player = $event->getPlayer();
		$stat = Loader::getInstance()->getSessionManager()->get($player);
		if ($stat !== null){
			$stat->setHealth($stat->getMaxHealth());
			$stat->setMana($stat->getMaxMana());
		}
	}
}