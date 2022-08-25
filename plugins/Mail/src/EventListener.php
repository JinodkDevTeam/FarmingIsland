<?php
declare(strict_types=1);

namespace Mail;

use JinodkDevTeam\utils\PlayerUtils;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use SOFe\AwaitGenerator\Await;

class EventListener implements Listener{

	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		Await::f2c(function() use ($player){
			$unread = yield from $this->getLoader()->getProvider()->selectUnread($player->getName());
			$count = count($unread);
			if ($count > 0){
				PlayerUtils::addToast($player, "MailSystem", "You have " . $count . " unread messages !");
			}
		});
	}
}