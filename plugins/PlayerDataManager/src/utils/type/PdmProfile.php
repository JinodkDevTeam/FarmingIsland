<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils\type;

use NgLam2911\PlayerDataManager\utils\ExampleProfileNames;
use pocketmine\player\Player;
use Ramsey\Uuid\Uuid;

class PdmProfile{

	protected int $profile_id;
	protected string $profile_name;
	protected string $xuid;
	protected string $savekey;

	public function __construct(int $profile_id, string $profile_name, string $xuid, string $savekey){
		$this->profile_id = $profile_id;
		$this->profile_name = $profile_name;
		$this->xuid = $xuid;
		$this->savekey = $savekey;
	}

	public function getProfileId() : int{
		return $this->profile_id;
	}

	public function getProfileName() : string{
		return $this->profile_name;
	}

	public function getXuid() : string{
		return $this->xuid;
	}

	public function getSavekey() : string{
		return $this->savekey;
	}

	public static function new(Player|PdmPlayer|string $xuid) : PdmProfile{
		if($xuid instanceof Player or $xuid instanceof PdmPlayer){
			$xuid = $xuid->getXuid();
		}
		$new_profile_id = 0;
		$new_profile_name = ExampleProfileNames::NAMES[array_rand(ExampleProfileNames::NAMES)];
		$new_profile_savekey = Uuid::getFactory()->uuid4()->toString();
		return new PdmProfile(
			$new_profile_id,
			$new_profile_name,
			$xuid,
			$new_profile_savekey
		);
	}
}