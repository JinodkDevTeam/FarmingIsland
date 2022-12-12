<?php
declare(strict_types=1);

namespace FILang;

use Exception;
use FILang\sessions\Session;
use FILang\sessions\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{
	protected FILang $plugin;

	public function __construct(FILang $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @param PlayerJoinEvent $event
	 * @priority LOW
	 *
	 * @return void
	 */
	public function onPlayerJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$session = SessionManager::getSession($player);
		if ($session === null) {
			$lang = $this->plugin->data->get($player->getUniqueId()->toString(), "eng") ?? "eng";
			$session = new Session($lang);
			SessionManager::addSession($player, $session);
		}
	}

	/**
	 * @param PlayerQuitEvent $event
	 *
	 * @priority LOW
	 * @return void
	 */
	public function onQuit(PlayerQuitEvent $event) : void{
		$player = $event->getPlayer();
		//Save data
		$session = SessionManager::getSession($player);
		if ($session !== null) {
			$this->plugin->data->set($player->getUniqueId()->toString(), $session->getLang());
			try{
				$this->plugin->data->save();
			} catch(Exception){
				$this->plugin->getLogger()->error("Failed to save data.yml");
			}
			SessionManager::removeSession($player);
		}
	}
}