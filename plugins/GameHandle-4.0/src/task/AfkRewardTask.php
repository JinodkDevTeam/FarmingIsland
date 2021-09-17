<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\task;

use NgLamVN\GameHandle\Core;
use onebone\economyapi\EconomyAPI;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class AfkRewardTask extends Task{
	public function onRun() : void{
		$players = Server::getInstance()->getOnlinePlayers();
		foreach($players as $player){
			if($player->getWorld()->getDisplayName() == "afk"){
				if(isset($this->getCore()->afktime[$player->getName()])){
					if($this->getCore()->afktime[$player->getName()] == 1) //Tự hiểu
					{
						EconomyAPI::getInstance()->addMoney($player, 200);
						$player->sendMessage("§aYou have get 200xu in AFK Area !");
						$this->getCore()->afktime[$player->getName()] = 0;
					}else{
						$this->getCore()->afktime[$player->getName()]++;
					}
				}else{
					$this->getCore()->afktime[$player->getName()] = 1;
				}
			}
		}
	}

	public function getCore() : ?Core{
		return Core::getInstance();
	}
}
