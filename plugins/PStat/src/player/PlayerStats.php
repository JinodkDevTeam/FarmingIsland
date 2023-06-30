<?php
declare(strict_types=1);

class PlayerStats{

	/* =======================================GENERAL====================================== */
	/**
	 * @var float $health
	 * @description Player's current health
	 */
	protected float $health = 100;
	/**
	 * @var float $maxHealth
	 * @description Player's max health
	 */
	protected float $maxHealth = 100;

	/**
	 * @var float $health_regen
	 * @description Player's health regen multiplier
	 */
	protected float $health_regen = 1;

	/**
	 * @var float $vitality
	 * @description Player's vitality, use for incomming healing multiplier
	 */
	protected float $vitality = 1;

	/**
	 * @var float $mending
	 * @description Player's mending, use for increase outcomming healing multiplier
	 */
	protected float $mending = 1;

	/* =======================================MAGIC====================================== */
	/**
	 * @var float $mana
	 * @description Player's current mana
	 */
	protected float $mana = 100;
	/**
	 * @var float $maxMana
	 * @description Player's max mana
	 */
	protected float $maxMana = 100;
	/**
	 * @var float $intelligence
	 * @description Player's intelligence, use for increase max mana, mana regen, magic damage
	 */
	protected float $intelligence = 0;

	/**
	 * @var float $mana_regen
	 * @description Player's mana regen multiplier
	 */
	protected float $mana_regen = 0.02; //2% mana regen

	/**
	 * @var float $ability_damage
	 * @description Player's ability damage multiplier
	 */
	protected float $ability_damage = 0;

	/* =======================================COMBAT====================================== */
	/**
	 * @var float $strength
	 * @description Player's strength, use for increase damage dear with melee or ranged attack damage.
	 */
	protected float $strength = 0;

	/**
	 * @var float $crit_chance
	 * @description Player's critical chance, use for increase chance to deal critical damage, capped at 1
	 */
	protected float $crit_chance = 0.5; //50% crit chance

	/**
	 * @var float $crit_damage
	 * @description Player's critical damage, use for increase critical damage multiplier
	 */
	protected float $crit_damage = 0.5; //+50% damage

	/**
	 * @var float $attack_speed
	 * @description Player's attack speed multiplier, cappped at 1
	 */
	protected float $attack_speed = 0; //0% attack speed

	/**
	 * @var float $ferocity
	 * @description Player's ferocity, use for increase the amount of hits that can be dealt in one attack (multiplier), capped at 5
	 */
	protected float $ferocity = 0;

	/**
	 * @var float $defense
	 * @description Player's defense, use for reduce incomming damage
	 */
	protected float $defense = 0;

	/**
	 * @var float $true_defense
	 * @description Player's true defense, use for reduce incomming true damage that ignore defense
	 */
	protected float $true_defense = 0;

	/*=======================================MISC====================================== */
	/**
	 * @var float $speed
	 * @description Player's speed, use for increase player's movement speed
	 */
	protected float $speed = 0;

	/**
	 * @var float $magic_find
	 * @description Player's magic find, use for increase chance to get rare item
	 */
	protected float $magic_find = 0;

	/*=======================================SKILLS====================================== */
	/**
	 * @var float $farming_fortune
	 * @description Player's farming fortune, use for increase chance to get more drop from farming
	 */
	protected float $farming_fortune = 0;

	/**
	 * @var float $mining_fortune
	 * @description Player's mining fortune, use for increase chance to get more drop from mining
	 */
	protected float $mining_fortune = 0;

	/**
	 * @var float $foraging_fortune
	 * @description Player's foraging fortune, use for increase chance to get more drop from foraging
	 */
	protected float $foraging_fortune = 0;

	/**
	 * @var float $fishing_fortune
	 * @description Player's fishing fortune, use for increase chance to get more drop from fishing
	 */
	protected float $fishing_fortune = 0;

	/**
	 * @var float $fishing_speed
	 * @description Player's fishing speed
	 */
	protected float $fishing_speed = 0;

	/**
	 * @var float $sea_creature_chance
	 * @description Player's sea creature chance, use for increase chance to fish up sea creature
	 */
	protected float $sea_creature_chance = 0;

	/**
	 * @var float $mining_wisdom
	 * @description Player's mining wisdon, use for increase xp gain from mining
	 */
	protected float $mining_wisdom = 0;

	/**
	 * @var float $farming_wisdom
	 * @description Player's farming wisdon, use for increase xp gain from farming
	 */
	protected float $farming_wisdom = 0;

	/**
	 * @var float $foraging_wisdom
	 * @description Player's foraging wisdon, use for increase xp gain from foraging
	 */
	protected float $foraging_wisdom = 0;

	/**
	 * @var float $fishing_wisdom
	 * @description Player's fishing wisdon, use for increase xp gain from fishing
	 */
	protected float $fishing_wisdom = 0;

	/**
	 * @var float $combat_wisdom
	 * @description Player's combat wisdon, use for increase xp gain from combat
	 */
	protected float $combat_wisdom = 0;

	/*=======================================BASE====================================== */






}