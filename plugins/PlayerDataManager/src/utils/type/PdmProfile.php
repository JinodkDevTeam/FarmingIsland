<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils\type;

use NgLam2911\PlayerDataManager\utils\ExampleProfileNames;
use NgLam2911\PlayerDataManager\utils\ProfileTypes;
use pocketmine\player\Player;
use Ramsey\Uuid\Uuid;

readonly class PdmProfile{

	public function __construct(
		protected string $profile_id,
		protected string $profile_name,
		protected ProfileTypes $profile_type,
	){}

	public function getProfileUUID() : string{
		return $this->profile_id;
	}

	public function getProfileName() : string{
		return $this->profile_name;
	}

	public function getType() : ProfileTypes{
		return $this->profile_type;
	}

	public static function new(ProfileTypes|int $profile_type = ProfileTypes::DEFAULT_NORMAL) : PdmProfile{
		$new_profile_name = ExampleProfileNames::NAMES[array_rand(ExampleProfileNames::NAMES)];
		$new_profile_id = Uuid::getFactory()->uuid4()->toString();
		if (is_int($profile_type)){
			$profile_type = ProfileTypes::fromId($profile_type);
		}
		return new PdmProfile(
			$new_profile_id,
			$new_profile_name,
			$profile_type
		);
	}
}