<?php
declare(strict_types=1);

namespace NgLam2911\libAwaitEconomy;

use pocketmine\plugin\Plugin;
use pocketmine\Server;
use SOFe\AwaitGenerator\Await;

class AwaitEconomy{
	protected static Economy $economy;

	public static function init(Plugin $plugin) : void{
		self::detectEconomy();
		self::getEconomy()->init($plugin);
	}

	public static function getEconomy() : Economy{
		return self::$economy;
	}

	protected static function detectEconomy() : void{
		if (!is_null(Server::getInstance()->getPluginManager()->getPlugin("Capital"))){
			self::$economy = new CapitalEconomy();
			return;
		}
		if (!is_null(Server::getInstance()->getPluginManager()->getPlugin("BedrockEconomy"))){
			self::$economy = new BedrockEconomy();
			return;
		}
		if (!is_null(Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI"))){
			self::$economy = new EconomyAPI();
		}
	}
}