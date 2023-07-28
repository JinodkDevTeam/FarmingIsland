<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager;

use NgLam2911\PlayerDataManager\api\PdmApi;
use NgLam2911\PlayerDataManager\utils\type\PdmPlayer;
use NgLam2911\PlayerDataManager\utils\type\PdmProfile;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;
use SOFe\AwaitGenerator\Await;

class EventListener implements Listener{

	protected PDM $pdm;

	public function __construct(PDM $pdm){
		$this->pdm = $pdm;
	}

	public function getPDM() : PDM{
		return $this->pdm;
	}

	/**
	 * @param PlayerJoinEvent $event
	 * @priority LOWEST
	 *
	 * @return void
	 */
	public function onJoin(PlayerJoinEvent $event) : void{
		Await::f2c(function() use ($event){
			//TODO: BLABLA
			//Check if player have registered in system, if not, create a new player data
			/** @var PdmPlayer|null $player */
			$player = yield from PdmApi::asyncGetPdmPlayer($event->getPlayer()->getXuid());
			if ($player === null){
				//Create player data
				yield from PdmApi::asyncInitNewPlayer($event->getPlayer());
				$player = yield from PdmApi::asyncGetPdmPlayer($event->getPlayer()->getXuid());
			}
			//TODO: Something else
		});
	}

	/**
	 * @param PlayerQuitEvent $event
	 * @priority MONITOR
	 *
	 * @return void
	 */
	public function onQuit(PlayerQuitEvent $event) : void{
		Await::f2c(function() use ($event){
			//Save data from a player
			yield from PdmApi::asyncSave($event->getPlayer());
		});
	}
}