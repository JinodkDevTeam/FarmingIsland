<?php
declare(strict_types=1);

namespace NgLam2911\libAwaitEconomy;

use Generator;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use RuntimeException;
use SOFe\Capital\AccountRef;
use SOFe\Capital\Capital;
use SOFe\Capital\CapitalException;
use SOFe\Capital\LabelSet;
use SOFe\Capital\Schema\Complete;

class CapitalEconomy implements Economy{

	protected Complete $selector;
	protected Capital $capital;


	public function init(Plugin $plugin) : void{
		Capital::api("0.1.0", function(Capital $api) use ($plugin){
			$this->selector = $api->completeConfig($plugin->getConfig()->get("capital-selector"));
		});
		$capital = Server::getInstance()->getPluginManager()->getPlugin("Capital");
		if ($capital instanceof Capital){
			$this->capital = $capital;
		} else {
			throw new RuntimeException("Can't get Capital API");
		}
	}

	public function getMoney(Player $player) : Generator{
		try{
			return yield from $this->capital->getBalance(new AccountRef($player->getUniqueId()));
		}catch(CapitalException){
			return yield null;
		}
	}

	public function setMoney(Player $player, float $value) : Generator{
		try{
			//UNKNOWN
			return yield true;
		}catch(CapitalException){
			return yield false;
		}
	}

	public function addMoney(Player $player, float $value) : Generator{
		try{
			yield from $this->capital->addMoney("", $player, $this->selector, (int) $value, new LabelSet([]));
			//TODO: oracleName, LabelSet
			return yield true;
		} catch(CapitalException){
			return yield false;
		}
	}

	public function takeMoney(Player $player, float $value) : Generator{
		try{
			yield from $this->capital->takeMoney("", $player, $this->selector, (int) $value, new LabelSet([]));
			//TODO: oracleName, LabelSet
			return yield true;
		} catch(CapitalException){
			return yield false;
		}
	}

}