<?php
declare(strict_types=1);

namespace Mail;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
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

	/**
	 * @param PlayerJoinEvent $event
	 * @priority MONITOR
	 * @handleCancelled false
	 * @return void
	 */
	public function onJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		Await::f2c(function() use ($player){
			$unread = yield from $this->getLoader()->getProvider()->selectUnread($player->getName());
			$count = count($unread);
			if ($count > 0){
				$player->sendToastNotification(Lang::translate($player, TF::mail_toast_title()), Lang::translate($player, TF::mail_toast_unread((string)$count)));
			}
		});
	}
}