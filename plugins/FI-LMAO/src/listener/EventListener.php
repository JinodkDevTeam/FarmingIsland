<?php
declare(strict_types=1);

namespace LMAO\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener{

	public function onChat(PlayerChatEvent $event){
		$message = $event->getMessage();
	}
}