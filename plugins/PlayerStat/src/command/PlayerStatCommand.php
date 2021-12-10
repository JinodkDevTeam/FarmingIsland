<?php
declare(strict_types=1);

namespace PlayerStat\command;

use PlayerStat\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class PlayerStatCommand extends Command implements PluginOwned{

	public function __construct(){
		parent::__construct("playerstat");
		$this->setPermission("playerstat.cmd");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender instanceof Player){
			$sender->sendMessage("Currently, this command can only use in game !");
			return;
		}
		if (!$sender->hasPermission("playerstat.cmd")){
			return;
		}
		if (!isset($args[0])){
			$sender->sendMessage("Invalid option !");
			return;
		}
		if (!isset($args[1])){
			if ($args[0] !== "info"){
				$sender->sendMessage("Invalid value");
				return;
			} else {
				$value = 0;
			}
		} else {
			$value = $args[1];
		}
		$option = $args[0];
		if (!is_numeric($value)){
			$sender->sendMessage("Invalid value");
			return;
		}
		$value = (float)$value;
		$stat = Loader::getInstance()->getSessionManager()->get($sender);
		if ($stat == null){
			$sender->sendMessage("Cant find stat data !");
			return;
		}
		switch($option){
			case "info":
				$sender->sendMessage("Max Health: ".$stat->getMaxHealth());
				$sender->sendMessage("Health: ".$stat->getHealth());
				$sender->sendMessage("Max mana: ".$stat->getMaxMana());
				$sender->sendMessage("Mana: ".$stat->getMana());
				$sender->sendMessage("Intelligence: ".$stat->getIntelligence());
				$sender->sendMessage("Health regeneration: ".$stat->getHealthRegeneration());
				$sender->sendMessage("Mana regeneration: ".$stat->getManaRegeneration());
				$sender->sendMessage("Defense: ".$stat->getDefense());
				$sender->sendMessage("True Defense(N/A): ".$stat->getTrueDefense());
				$sender->sendMessage("Knockback resistance: ".$stat->getKnockbackResistance());
				$sender->sendMessage("True Knockback resistance(N/A): ".$stat->getTrueKnockbackResistance());
				$sender->sendMessage("Strength: ".$stat->getStrength());
				$sender->sendMessage("Damage(WIP): ".$stat->getDamage());
				$sender->sendMessage("True Damage(N/A): ".$stat->getTrueDamage());
				$sender->sendMessage("Crit Chance: ".$stat->getCritChance());
				$sender->sendMessage("Crit Damage: ".$stat->getCritDamage());
				$sender->sendMessage("Attack speed: ".$stat->getAttackSpeed());
				$sender->sendMessage("Ferocity: ".$stat->getFerocity());
				$sender->sendMessage("Knockback: ".$stat->getKnockback());
				$sender->sendMessage("True Knockback(N/A): ".$stat->getTrueKnockback());
				//MORE !
				break;
			case "max-health":
				$stat->setMaxHealth($value);
				break;
			case "health":
				$stat->setHealth($value);
				break;
			case "max-mana":
				$stat->setMaxMana($value);
				break;
			case "mana":
				$stat->setMana($value);
				break;
			case "intelligence":
				$stat->setIntelligence($value);
				break;
			case "health-regeneration":
				$stat->setHealthRegeneration($value);
				break;
			case "mana-regeneration":
				$stat->setManaRegeneration($value);
				break;
			case "defense":
				$stat->setDefense($value);
				break;
			case "knockback-resistance":
				$stat->setKnockbackResistance($value);
				break;
			case "strength":
				$stat->setStrength($value);
				break;
			case "damage":
				$stat->setDamage($value);
				break;
			case "crit-chance":
				$stat->setCritChance($value);
				break;
			case "crit-damage":
				$stat->setCritDamage($value);
				break;
			case "attack-speed":
				$stat->setAttackSpeed($value);
				break;
			case "ferocity":
				$stat->setFerocity($value);
				break;
			case "knockback":
				$stat->setKnockback($value);
				break;
			default:
				$sender->sendMessage("Invalid Option !");
		}
	}

	public function getOwningPlugin() : Plugin{
		return Loader::getInstance();
	}
}