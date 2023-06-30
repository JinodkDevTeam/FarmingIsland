<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils\type;

use pocketmine\player\Player;

class PdmPlayer{
	protected string $gametag;
	protected string $xuid;
	protected int $currentProfile;
	public function __construct(string $gametag, string $xuid, int $currentProfile){
		$this->gametag = $gametag;
		$this->xuid = $xuid;
		$this->currentProfile = $currentProfile;
	}

	public function getGametag() : string{
		return $this->gametag;
	}

	public function getXuid() : string{
		return $this->xuid;
	}

	public function getName() : string{
		return $this->getGametag();
	}

	public function getCurrentProfileID() : int{
		return $this->currentProfile;
	}

	public static function fromPmPlayer(Player $player) : PdmPlayer{
		return new PdmPlayer($player->getName(), $player->getXuid(), -1);
	}
}