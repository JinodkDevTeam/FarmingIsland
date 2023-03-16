<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper;

use NgLam2911\MineSweeper\area\AreaManager;
use NgLam2911\MineSweeper\session\Session;
use NgLam2911\MineSweeper\session\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{

	/**
	 * @param PlayerInteractEvent $event
	 * @priority MONITOR
	 * @handleCancelled false
	 *
	 * @return void
	 */
	public function onInteractBlock(PlayerInteractEvent $event) : void{
		if ($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			$area = AreaManager::getInstance()->fromPosition($event->getBlock()->getPosition());
			$area?->onInteract($event->getPlayer(), $event->getBlock()->getPosition(), $event->getItem());
		}
	}

	/**
	 * @param PlayerJoinEvent $event
	 * @priority MONITOR
	 * @return void
	 */
	public function onJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		$session = new Session($player);
		SessionManager::getInstance()->addSession($session);
	}

	/**
	 * @param PlayerQuitEvent $event
	 * @priority MONITOR
	 * @return void
	 */
	public function onQuit(PlayerQuitEvent $event) : void{
		$player = $event->getPlayer();
		$session = SessionManager::getInstance()->getSession($player->getName());
		if ($session !== null){
			$areas = $session->getPlayingAreas();
			foreach ($areas as $area){
				$area->removePlayer($session);
				if ($area->getOwner() === $session){
					if ($area->getBoard() !== null){
						$area->setBoard(null);
					}
					AreaManager::getInstance()->removeArea($area->getName());
				}
			}
			SessionManager::getInstance()->removeSession($session);
		}
	}
}