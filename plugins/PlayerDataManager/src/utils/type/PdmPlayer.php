<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils\type;

use pocketmine\player\Player;

readonly class PdmPlayer{
	public function __construct(
		protected string $gametag,
		protected string $xuid,
		protected string $currentProfile
	){}

	public function getGametag() : string{
		return $this->gametag;
	}

	public function getXuid() : string{
		return $this->xuid;
	}

	public function getName() : string{
		return $this->getGametag();
	}

	public function getCurrentProfileUUID() : string{
		return $this->currentProfile;
	}

	public static function newfromPmPlayer(Player $player) : PdmPlayer{
		return new PdmPlayer($player->getName(), $player->getXuid(), "");
	}
}