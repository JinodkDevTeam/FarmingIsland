<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager;

use NgLam2911\PlayerDataManager\utils\type\PdmPlayer;
use NgLam2911\PlayerDataManager\utils\type\PdmProfile;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
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
			$player = $event->getPlayer();
			//Loading player data
			$this->getPDM()->getLogger()->debug("Loading player data for " . $player->getName());
			/** @var PdmPlayer|null|bool $data */
			$data = yield from $this->getPDM()->getProvider()->selectPlayerXuid($player->getXuid());
			if ($data === false){
				$this->onDatabaseError();
			}
			if ($data === null){
				$this->getPDM()->getLogger()->debug("Player data not found, creating new data");
				/** @var int|null $success */
				$success = yield from $this->getPDM()->getProvider()->registerPlayer($player);
				if ($success === null){
					$this->onDatabaseError();
				}
			} else {
				if ($data->getGametag() !== $player->getName()){
					$this->getPDM()->getLogger()->debug("Player gametag changed, updating data ...");
					/** @var int|null $success */
					$success = yield from $this->getPDM()->getProvider()->updatePlayerGametag($player->getName(), $player->getXuid());
					if ($success === null){
						$this->onDatabaseError();
					}
				}
			}
			$this->getPDM()->getLogger()->debug("Base player data loaded. Loading profile info...");
			/** @var PdmProfile|null|bool $currentProfile */
			$currentProfile = yield from $this->getPDM()->getProvider()->selectCurrentProfileXuid($player->getXuid());
			if ($currentProfile === false){
				$this->onDatabaseError();
			}
			if ($currentProfile === null){
				$this->getPDM()->getLogger()->debug("Player current profile not found, creating new profile...");
				/** @var int|null $success */
				$success = yield from $this->getPDM()->getProvider()->registerProfile($player);
				if ($success === null){
					$this->onDatabaseError();
				}
				$this->getPDM()->getLogger()->debug("Profile created, getting profiles info...");
				/** @var PdmProfile[]|null| $profiles */
				$profiles = yield from $this->getPDM()->getProvider()->selectProfileXuid($player->getXuid());
				if ($profiles === null){
					$this->onDatabaseError();
				}
				if ($profiles === []){
					$this->getPDM()->getLogger()->debug("Something went wrong, no profile found ???");
					$this->onDatabaseError();
				}
				$currentProfile = $profiles[0];
				$this->getPDM()->getLogger()->debug("Profile info loaded, auto updating current profile...");
				/** @var int|null $success */
				$success = yield from $this->getPDM()->getProvider()->updateCurrentProfile($currentProfile->getProfileId(), $player->getXuid());
				if ($success === null){
					$this->onDatabaseError();
				}
			}
			$this->getPDM()->getLogger()->debug("Completed loading player data for player " . $player->getName());
		});
	}

	public function onDatabaseError() : void{
		$this->getPDM()->getLogger()->error("Failed to execute query to database");
		Server::getInstance()->shutdown();
	}
}