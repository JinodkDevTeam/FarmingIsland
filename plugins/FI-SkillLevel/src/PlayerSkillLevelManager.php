<?php
declare(strict_types=1);

namespace SkillLevel;

use pocketmine\player\Player;

class PlayerSkillLevelManager{
	/** @var PlayerSkillLevel[] */
	private array $playerdatas = [];

	public function __construct(){
		//NOOP
	}

	public function registerPlayer(Player $player, array $data) : void{
		$psl = new PlayerSkillLevel($player, $data);

		if(!isset($this->playerdatas)){
			$this->playerdatas = [];
		}
		$this->playerdatas[$player->getName()] = $psl;
	}

	public function getPlayerSkillLevel(Player $player) : ?PlayerSkillLevel{
		if(isset($this->playerdatas[$player->getName()])){
			return $this->playerdatas[$player->getName()];
		}else{
			return null;
		}
	}

	public function unregisterPlayer(Player $player) : void{
		if(!isset($this->playerdatas[$player->getName()])) return;
		unset($this->playerdatas[$player->getName()]);
	}
}
