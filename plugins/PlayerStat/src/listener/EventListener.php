<?php
declare(strict_types=1);

namespace PlayerStat\listener;

use PlayerStat\entity\DamageTagEntity;
use PlayerStat\Loader;
use PlayerStat\session\PlayerSession;
use PlayerStat\utils\ChanceCaculator;
use PlayerStat\utils\CritDmgFormater;
use pocketmine\entity\Living;
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
				//DamageTag
				$damage = round($event->getFinalDamage(), 2);
				$location = $victim->getLocation();
				$location->y += 1.5;
				$tag = (string)$damage;
				if (isset($crit)){
					if ($crit){
						$tag = CritDmgFormater::format($damage);
					}
				}
				$tag = new DamageTagEntity($location, $tag);
				$tag->spawnToAll();
				//Set damage to 0
				foreach(array_keys($event->getModifiers()) as $key){
					$event->setModifier(0, $key);
				}
				if ($event->getCause() !== EntityDamageEvent::CAUSE_LAVA){
					$event->setBaseDamage(0);
				} else {
					$event->setBaseDamage(4);
					$event->setModifier(-4, EntityDamageEvent::MODIFIER_RESISTANCE); //HACK: Fix spaming lava damage when recieve.
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
				$stat->show();
			}
		} else {
			//Normal entity.
			if ($victim instanceof Living){
				$damage = round($event->getFinalDamage(), 2);
				$location = $victim->getLocation();
				$location->y += 1.5;
				$tag = (string)$damage;
				if (isset($crit)){
					if ($crit){
						$tag = CritDmgFormater::format($damage);
					}
				}
				$tag = new DamageTagEntity($location, $tag);
				$tag->spawnToAll();
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