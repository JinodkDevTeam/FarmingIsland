<?php
declare(strict_types=1);

namespace NgLam2911\libAwaitEconomy;

use Generator;
use pocketmine\player\Player;
use onebone\economyapi\EconomyAPI as EcoAPI;
use pocketmine\plugin\Plugin;

class EconomyAPI implements Economy{

	public function init(Plugin $plugin) : void{
		//NOTHING
	}

	public function getMoney(Player $player) : Generator{
		return yield EcoAPI::getInstance()->myMoney($player);
	}

	public function setMoney(Player $player, float $value) : Generator{
		$result = EcoAPI::getInstance()->setMoney($player, $value);
		if ($result == EcoAPI::RET_SUCCESS){
			return yield true;
		}
		return yield false;
	}

	public function addMoney(Player $player, float $value) : Generator{
		$result = EcoAPI::getInstance()->addMoney($player, $value);
		if ($result == EcoAPI::RET_SUCCESS){
			return yield true;
		}
		return yield false;
	}

	public function takeMoney(Player $player, float $value) : Generator{
		$result = EcoAPI::getInstance()->reduceMoney($player, $value);
		if ($result == EcoAPI::RET_SUCCESS){
			return yield true;
		}
		return yield false;
	}
}