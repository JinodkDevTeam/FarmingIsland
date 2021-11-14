<?php
declare(strict_types=1);

namespace NgLamVN\FIScore;

use Ifera\ScoreHud\event\TagsResolveEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\Server;

class TagResloveListener implements Listener{

	public function onTagReslove(TagsResolveEvent $event){
		$player = $event->getPlayer();
		$tag = $event->getTag();
		$name = $tag->getName();

		switch($name){
			case "fi-scoreloader.coin":
				$value = EconomyAPI::getInstance()->myMoney($player);
				$tag->setValue((string) $value);
				break;
			case "fi-scoreloader.gem":
				$currency = EconomyAPI::getInstance()->getCurrency('gem');
				$value = EconomyAPI::getInstance()->myMoney($player, $currency);
				if ($value === false){
					$value = 0;
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
		}
	}
}
