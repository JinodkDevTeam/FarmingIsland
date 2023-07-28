<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils\type;

use JinodkDevTeam\utils\ItemUtils;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Ramsey\Uuid\Uuid;

readonly class PdmProfilePlayer{

	public function __construct(
		protected string $profile_player_id,
		protected string $profile_id,
		protected string $xuid,
		protected string $inventory,
	){
	}

	public function getProfilePlayerUUID() : string{
		return $this->profile_player_id;
	}

	public function getProfileUUID() : string{
		return $this->profile_id;
	}

	public function getXuid() : string{
		return $this->xuid;
	}

	public function getRawInventory() : string{
		return $this->inventory;
	}

	/**
	 * @return Item[]
	 */
	public function getInventory() : array{
		return ItemUtils::binString2itemArray($this->inventory);
	}

	public static function new(Player|PdmPlayer|string $xuid, PdmProfile|string $profileUUID) : self{
		if ($xuid instanceof Player){
			$xuid = $xuid->getXuid();
		}
		if ($xuid instanceof PdmPlayer){
			$xuid = $xuid->getXuid();
		}
		if ($profileUUID instanceof PdmProfile){
			$profileUUID = $profileUUID->getProfileUUID();
		}
		return new PdmProfilePlayer(
			Uuid::getFactory()->uuid4()->toString(),
			$profileUUID,
			$xuid,
			""
		);
	}
}