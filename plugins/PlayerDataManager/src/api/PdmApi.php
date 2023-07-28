<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\api;

use NgLam2911\PlayerDataManager\PDM;
use NgLam2911\PlayerDataManager\utils\type\PdmPlayer;
use NgLam2911\PlayerDataManager\utils\type\PdmProfile;
use NgLam2911\PlayerDataManager\utils\type\PdmProfilePlayer;
use NgLam2911\PlayerDataManager\utils\Utils;
use pocketmine\player\Player;
use Generator;
use Ramsey\Uuid\Uuid;

class PdmApi{

	/**
	 * @param Player $player
	 *
	 * @return Generator<void>
	 * @description Create a new player base data asynchorously, doesnt care about the player have been registered or not,
	 * use it with caution, may cause error when a player have been registered
	 */
	public static function asyncInitNewPlayer(Player $player) : Generator{
		//Create a new player data
		yield from PDM::getInstance()->getProvider()->registerPlayer($player);
		//Create a new solo profile
		$newProfile = PdmProfile::new();
		yield from PDM::getInstance()->getProvider()->registerProfile($newProfile);
		//Create a new profile player in the solo profile
		$newProfilePlayer = PdmProfilePlayer::new($player, $newProfile);
		yield from PDM::getInstance()->getProvider()->registerProfilePlayer($newProfilePlayer);
		//Update the player current profile
		yield from PDM::getInstance()->getProvider()->updateCurrentProfile($newProfile->getProfileUUID(), $player->getXuid());
	}

	/**
	 * @param string $data Player gametag or xuid
	 *
	 * @return Generator<PdmPlayer|null>
	 */
	public static function asyncGetPdmPlayer(string $data) : Generator{
		//Check if the player is registered
		if (Uuid::isValid($data)){
			return yield from PDM::getInstance()->getProvider()->selectPlayerXuid($data);
		}
		return yield from PDM::getInstance()->getProvider()->selectPlayerGametag($data);
	}

	/**
	 * @param Player $player
	 *
	 * @return Generator<void>
	 */
	public static function asyncSave(Player $player) : Generator{
		$content = Utils::inventorySerializer($player);
		/** @var PdmPlayer|null $pdmPlayer */
		$pdmPlayer = yield from self::asyncGetPdmPlayer($player->getXuid());
		if ($pdmPlayer === null){
			//TODO: Throw error
			return;
		}
		$profileUUID = $pdmPlayer->getCurrentProfileUUID();
		/** @var PdmProfilePlayer|null $profilePlayer */
		$profilePlayer = yield from PDM::getInstance()->getProvider()->selectProfilePlayerXuidProfileId($profileUUID, $player->getXuid());
		if ($profilePlayer === null){
			//TODO: Throw error
			return;
		}
		yield from PDM::getInstance()->getProvider()->updateProfilePlayerInventory($profilePlayer->getProfilePlayerUUID(), $content);
	}
}