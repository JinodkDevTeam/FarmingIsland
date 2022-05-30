<?php
declare(strict_types=1);

namespace NgLam2911\PlayerProfile;

use pocketmine\player\Player as PMPlayer;

class Player extends PMPlayer{

	protected ?Profile $profile = null;

	/**
	 * @return string
	 */
	public function getName() : string{
		$username = $this->username;

		if($this->hasSpaces($username)){
			$username = str_replace(" ", "_", $username);

			$this->username = $username;
			$this->displayName = $username;

			return $username;
		}

		return $username;
	}

	/**
	 * @param string $string
	 *
	 * @return bool
	 */
	private function hasSpaces(string $string) : bool{
		return str_contains($string, ' ');
	}

	/**
	 * @return string
	 */
	public function getDisplayName() : string{
		$displayName = $this->displayName;

		if($this->hasSpaces($displayName)){
			$displayName = str_replace(" ", "_", $displayName);

			$this->username = $displayName;
			$this->displayName = $displayName;

			return $displayName;
		}

		return $displayName;
	}

	public function getProfile() : ?Profile{
		return $this->profile;
	}

	public function setProfile(Profile $profile) : void{
		$this->profile = $profile;
	}
}