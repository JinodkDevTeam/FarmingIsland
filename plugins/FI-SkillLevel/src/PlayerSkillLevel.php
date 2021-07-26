<?php

namespace SkillLevel;

use pocketmine\player\Player;
use pocketmine\Server;

class PlayerSkillLevel{
	private Player $player;

	public function __construct(Player $player, array $data){
		$this->player = $player;
		$this->data = $data;
	}

	public function getData() : array{
		return $this->data;
	}

	public function setData(array $data) : void{
		$this->data = $data;
		$this->update();
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getSkillLevel(int $skill_code) : int{
		return $this->data[$this->IDLevelParser($skill_code)];
	}

	public function getSkillExp(int $skill_code) : int{
		return $this->data[$this->IDExpParser($skill_code)];
	}

	public function setSkillLevel(int $skill_code, int $level) : void{
		$this->data[$this->IDLevelParser($skill_code)] = $level;
		$this->update();
	}

	public function setSkillExp(int $skill_code, int $exp) : void{
		$this->data[$this->IDExpParser($skill_code)] = $exp;
		$this->update();
	}

	public function addSkillExp(int $skill_code, int $exp) : void{
		$this->setSkillExp($skill_code, $this->getSkillExp($skill_code) + $exp);
	}

	public function IDLevelParser(int $code = 0) : string{
		switch($code){
			case SkillLevel::MINING:
				return "MiningLevel";
			case SkillLevel::FISHING:
				return "FishingLevel";
			case SkillLevel::FARMING:
				return "FarmingLevel";
			case SkillLevel::FORAGING:
				return "ForagingLevel";
			default:
				return "";
		}
	}

	public function IDExpParser(int $code = 0) : string{
		switch($code){
			case SkillLevel::MINING:
				return "MiningExp";
			case SkillLevel::FISHING:
				return "FishingExp";
			case SkillLevel::FARMING:
				return "FarmingExp";
			case SkillLevel::FORAGING:
				return "ForagingExp";
			default:
				return "";
		}
	}

	public function update()
	{
		$plugin = Server::getInstance()->getPluginManager()->getPlugin("FI-SKillLevel");
		if ($plugin instanceof SkillLevel)
		{
			$plugin->getPlayerSkillLevelManager()->registerPlayer($this->getPlayer(), $this->getData());
		}
	}

}