<?php
declare(strict_types=1);

namespace PlayerStat\session;

use pocketmine\player\Player;

class PlayerSession{
	public const BASE_MANA = 100;
	public const BASE_HEALTH = 100;
	public const BASE_DAMAGE = 1; //Attack by hand.

	protected Player $player;
	protected float $max_health;
	protected float $health;
	protected float $speed;
	protected float $max_mana;
	protected float $mana;
	protected float $intelligence; //max_mana = base + intelligence;
	protected float $health_regeneration;
	protected float $mana_regeneration;
	//Protection related
	protected float $defense;
	protected float $true_defense;
	protected float $knockback_resistance; //If set to -1, grant immune to normal knockback
	protected float $true_knockback_resistance; //If set to -1, grant immune to true knockback
	//Attack related
	protected float $strength;
	protected float $damage;
	protected float $true_damage;
	protected float $crit_chance;
	protected float $crit_damage;
	protected float $attack_speed;
	protected float $ferocity;
	protected float $knockback;
	protected float $true_knockback;
	//For mining, farming, foraging stat
	protected float $mining_fortune;
	protected float $farming_fortune;
	protected float $foraging_fortune;

	public function __construct(
		Player $player,
		float $max_health = self::BASE_HEALTH,
		float $health = self::BASE_HEALTH,
		float $max_mana = self::BASE_MANA,
		float $mana = self::BASE_MANA,
		float $intelligence = 1200,
		float $health_regeneration = 1,
		float $mana_regeneration = 1,
		float $defense = 1600,
		float $true_defense = 0,
		float $knockback_resistance = 0,
		float $true_knockback_resistance = 0,
		float $strength = 212000,
		float $damage = 250,
		float $true_damage = 0,
		float $crit_chance = 100,
		float $crit_damage = 420000,
		float $attack_speed = 100,
		float $ferocity = 100000,
		float $knockback = 0,
		float $true_knockback = 0,
		float $mining_fortune = 0,
		float $farming_fortune = 0,
		float $foraging_fortune = 0
	){
		$this->player = $player;
		$this->max_health = $max_health;
		$this->health = $health;
		$this->max_mana = $max_mana + $intelligence;
		$this->mana = $mana;
		$this->intelligence = $intelligence;
		$this->health_regeneration = $health_regeneration;
		$this->mana_regeneration = $mana_regeneration;
		$this->defense = $defense;
		$this->true_defense = $true_defense;
		$this->knockback_resistance = $knockback_resistance;
		$this->true_knockback_resistance = $true_knockback_resistance;
		$this->strength = $strength;
		$this->damage = $damage;
		$this->true_damage = $true_damage;
		$this->crit_chance = $crit_chance;
		$this->crit_damage = $crit_damage;
		$this->attack_speed = $attack_speed;
		$this->ferocity = $ferocity;
		$this->knockback = $knockback;
		$this->true_knockback = $true_knockback;
		$this->mining_fortune = $mining_fortune;
		$this->farming_fortune = $farming_fortune;
		$this->foraging_fortune = $foraging_fortune;
	}

	public function getAttackSpeed() : float|int{
		return $this->attack_speed;
	}

	public function getCritChance() : float|int{
		return $this->crit_chance;
	}

	public function getCritDamage() : float|int{
		return $this->crit_damage;
	}

	public function getDamage() : float|int{
		return $this->damage;
	}

	public function getDefense() : float|int{
		return $this->defense;
	}

	public function getFarmingFortune() : float|int{
		return $this->farming_fortune;
	}

	public function getFerocity() : float|int{
		return $this->ferocity;
	}

	public function getForagingFortune() : float|int{
		return $this->foraging_fortune;
	}

	public function getHealth() : float|int{
		return $this->health;
	}

	public function getHealthRegeneration() : float|int{
		return $this->health_regeneration;
	}

	public function getIntelligence() : float|int{
		return $this->intelligence;
	}

	public function getKnockback() : float|int{
		return $this->knockback;
	}

	public function getKnockbackResistance() : float|int{
		return $this->knockback_resistance;
	}

	public function getMana() : float|int{
		return $this->mana;
	}

	public function getManaRegeneration() : float|int{
		return $this->mana_regeneration;
	}

	public function getMaxHealth() : float|int{
		return $this->max_health;
	}

	public function getMaxMana() : float|int{
		return $this->max_mana;
	}

	public function getMiningFortune() : float|int{
		return $this->mining_fortune;
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getSpeed() : float{
		return $this->speed;
	}

	public function getStrength() : float|int{
		return $this->strength;
	}

	public function getTrueDamage() : float|int{
		return $this->true_damage;
	}

	public function getTrueDefense() : float|int{
		return $this->true_defense;
	}

	public function getTrueKnockback() : float|int{
		return $this->true_knockback;
	}

	public function getTrueKnockbackResistance() : float|int{
		return $this->true_knockback_resistance;
	}

	public function setAttackSpeed(float|int $attack_speed) : void{
		$this->attack_speed = $attack_speed;
	}

	public function setCritChance(float|int $crit_chance) : void{
		$this->crit_chance = $crit_chance;
	}

	public function setCritDamage(float|int $crit_damage) : void{
		$this->crit_damage = $crit_damage;
	}

	public function setDamage(float|int $damage) : void{
		$this->damage = $damage;
	}

	public function setDefense(float|int $defense) : void{
		$this->defense = $defense;
	}

	public function setFarmingFortune(float|int $farming_fortune) : void{
		$this->farming_fortune = $farming_fortune;
	}

	public function setFerocity(float|int $ferocity) : void{
		$this->ferocity = $ferocity;
	}

	public function setForagingFortune(float|int $foraging_fortune) : void{
		$this->foraging_fortune = $foraging_fortune;
	}

	public function setHealth(float|int $health) : void{
		$this->health = $health;
	}

	public function setHealthRegeneration(float|int $health_regeneration) : void{
		$this->health_regeneration = $health_regeneration;
	}

	public function setIntelligence(float|int $intelligence) : void{
		$this->intelligence = $intelligence;
		$this->setMaxMana($this->getMaxMana() + $this->getIntelligence());
	}

	public function setKnockback(float|int $knockback) : void{
		$this->knockback = $knockback;
	}

	public function setKnockbackResistance(float|int $knockback_resistance) : void{
		$this->knockback_resistance = $knockback_resistance;
	}

	public function setMana(float|int $mana) : void{
		$this->mana = $mana;
	}

	public function setManaRegeneration(float|int $mana_regeneration) : void{
		$this->mana_regeneration = $mana_regeneration;
	}

	public function setMaxHealth(float|int $max_health) : void{
		$this->max_health = $max_health;
	}

	public function setMaxMana(float|int $max_mana) : void{
		$this->max_mana = $max_mana;
	}

	public function setMiningFortune(float|int $mining_fortune) : void{
		$this->mining_fortune = $mining_fortune;
	}

	public function setSpeed(float $speed) : void{
		$this->speed = $speed;
	}

	public function setStrength(float|int $strength) : void{
		$this->strength = $strength;
	}

	public function setTrueDamage(float|int $true_damage) : void{
		$this->true_damage = $true_damage;
	}

	public function setTrueDefense(float|int $true_defense) : void{
		$this->true_defense = $true_defense;
	}

	public function setTrueKnockback(float|int $true_knockback) : void{
		$this->true_knockback = $true_knockback;
	}

	public function setTrueKnockbackResistance(float|int $true_knockback_resistance) : void{
		$this->true_knockback_resistance = $true_knockback_resistance;
	}

	public function regenerateHealth() : void{
		if ($this->getHealth() < $this->getMaxHealth()){
			if (($this->getHealth() + $this->getHealthRegeneration()) > $this->getMaxHealth()){
				$this->setHealth($this->getMaxHealth());
			} else {
				$this->setHealth($this->getHealth() + $this->getHealthRegeneration());
			}
		}
	}

	public function updateHealth() : void{
		if ($this->getHealth() > $this->getMaxHealth()){
			$this->setHealth($this->getMaxHealth());
		}
	}

	public function regenerateMana() : void{
		if ($this->getMana() < $this->getMaxMana()){
			if (($this->getMana() + $this->getManaRegeneration()) > $this->getMaxMana()){
				$this->setMana($this->getMaxMana());
			} else {
				$this->setMana($this->getMana() + $this->getManaRegeneration());
			}
		}
	}

	public function updateMana() : void{
		if ($this->getMana() > $this->getMaxMana()){
			$this->setMana($this->getMaxMana());
		}
	}

	public function show() : void{
		if ($this->getPlayer()->isOnline()){
			$this->getPlayer()->sendPopup("§c".$this->getHealth()."/".$this->getMaxHealth()."❤      §a".$this->getDefense()."❈ Defense      §b".$this->getMana()."/".$this->getMaxMana()."✎ Mana");
		}
	}
}