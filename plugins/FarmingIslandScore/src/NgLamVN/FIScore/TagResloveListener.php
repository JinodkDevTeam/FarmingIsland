<?php
declare(strict_types=1);

namespace NgLamVN\FIScore;

use Ifera\ScoreHud\event\TagsResolveEvent;
use NgLamVN\GameHandle\Season;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\Server;

class TagResloveListener implements Listener{

	public function onTagReslove(TagsResolveEvent $event) : void{
		$player = $event->getPlayer();
		$tag = $event->getTag();
		$name = $tag->getName();

		switch($name){
			case "fi-scoreloader.coin":
				$value = EconomyAPI::getInstance()->myMoney($player);
				if($value === null or $value === false){
					$value = 0;
				}else{
					$value = round($value, 2, PHP_ROUND_HALF_DOWN);
				}
				$tag->setValue((string) $value);
				break;
			case "fi-scoreloader.gem":
				$currency = EconomyAPI::getInstance()->getCurrency('gem');
				$value = EconomyAPI::getInstance()->myMoney($player, $currency);
				if($value === null or $value === false){
					$value = 0;
				}else{
					$value = round($value, 2, PHP_ROUND_HALF_DOWN);
				}
				$tag->setValue((string) $value);
				break;
			case "fi-scoreloader.online":
				$online = count(Server::getInstance()->getOnlinePlayers());
				$tag->setValue((string) $online);
				break;
			case "fi-scoreloader.max_online":
				$max_online = Server::getInstance()->getMaxPlayers();
				$tag->setValue((string) $max_online);
				break;
			case "fi-scoreloader.ping":
				$ping = $player->getNetworkSession()->getPing();
				$tag->setValue((string) $ping);
				break;
			case "fi-scoreloader.name":
				$pname = $player->getName();
				$tag->setValue($pname);
				break;
			case "fi-scoreloader.season":
				$tag->setValue(Season::getSeason());
				break;
		}
	}
}
