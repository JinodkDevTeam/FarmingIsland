<?php
declare(strict_types=1);

/**
 * Bazaar Copyright (c) 2021-? JinodkDevTeam|NgLamVN
 * BazaarShop for FarmingIslandv2 [JINODK Network]
 * Written in PHP by NgLamVN <nglamvn2911@gmail.com> <github.com/NgLamVN>
 * Idea from Hypixel Skyblock
 *
 * This plugin is made only for JINODK Network.
 * Code style: Some of PocketMine-MP code style :V
 */

namespace Bazaar;

use Bazaar\command\BazaarCommand;
use Bazaar\provider\ShopYAMLProvider;
use Bazaar\provider\SqliteProvider;
use pocketmine\plugin\PluginBase;

class Bazaar extends PluginBase{

	public const PROVIDER = "sqlite"; //I set it as default because i dont have any other provider;

	private SqliteProvider $provider;
	private ShopYAMLProvider $shopYAMLProvider;

	public function onEnable() : void{
		$this->provider = new SqliteProvider($this);
		$this->provider->init();
		$this->shopYAMLProvider = new ShopYAMLProvider($this);
		$this->shopYAMLProvider->init();
		$this->getServer()->getCommandMap()->register("bazaar", new BazaarCommand($this));
	}

	public function onDisable() : void{
		$this->getProvider()->close();
		$this->getShopYAMLProvider()->close();
	}

	public function getProvider() : SqliteProvider{
		return $this->provider;
	}

	public function getShopYAMLProvider() : ShopYAMLProvider{
		return $this->shopYAMLProvider;
	}
}
