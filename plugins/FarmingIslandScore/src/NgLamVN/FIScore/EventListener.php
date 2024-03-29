<?php
declare(strict_types=1);

namespace NgLamVN\FIScore;

use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\event\ServerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use onebone\economyapi\event\money\MoneyChangedEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class EventListener implements Listener{
	public function onJoin(PlayerJoinEvent $event){
		(new ServerTagUpdateEvent(new ScoreTag("fi-scoreloader.online", strval(count(Server::getInstance()->getOnlinePlayers())))))->call();
	}

	/**
	 * @param PlayerQuitEvent $event
	 *
	 * @priority HIGHEST
	 */
	public function onQuit(PlayerQuitEvent $event){
		Server::getInstance()->getPluginManager()->getPlugin("FI-ScoreLoader")->getScheduler()->scheduleDelayedTask(new ClosureTask(function(){
			(new ServerTagUpdateEvent(new ScoreTag("fi-scoreloader.online", strval(count(Server::getInstance()->getOnlinePlayers())))))->call();
		}), 20);
	}

	/*public function onMoneyChange(MoneyChangedEvent $event){
		$username = $event->getUsername();
		if(is_null($username)){
			return;
		}

		$player = Server::getInstance()->getPlayerExact($username);

		if($player instanceof Player && $player->isOnline()){
			switch($event->getCurrency()->getName()){
				case "Coin":
					(new PlayerTagUpdateEvent($player, new ScoreTag("fi-scoreloader.coin", (string) round($event->getNewMoney(), 2, PHP_ROUND_HALF_DOWN))))->call();
					break;
				case "Gem":
					(new PlayerTagUpdateEvent($player, new ScoreTag("fi-scoreloader.gem", (string) round($event->getNewMoney(), 2, PHP_ROUND_HALF_DOWN))))->call();
			}
		}
	}*/
}
