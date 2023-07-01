<?php
declare(strict_types=1);

namespace NgLam2911\PlayerDataManager\utils;

enum ProfileTypes : int{
	case DEFAULT_NORMAL = 0;
	case DEFAULT_COOP = 1;
	//TODO: Add more gamemodes

	public function toString() : string{
		return match($this->value){
			0 => "Default Normal",
			1 => "Default Coop",
			default => "Unknown"
		};
	}

	public function getId() : int{
		return $this->value;
	}

	public static function fromId(int $id) : ProfileTypes{
		return match($id){
			1 => ProfileTypes::DEFAULT_COOP,
			default => ProfileTypes::DEFAULT_NORMAL
		};
	}
}