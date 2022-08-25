<?php
declare(strict_types=1);

namespace SkillLevel;

use pocketmine\player\Player;
use SkillLevel\event\PlayerUpdateExpEvent;

class PlayerSkillLevel{
	public const MAX_EXP = [
		0,
		50,
		125,
		200,
		300,
		500,
		750,
		1000,
		1500,
		2000,
		3500,
		5000,
		7500,
		10000,
		15000,
		20000,
		30000,
		50000,
		75000,
		100000,
		200000,
		300000,
		400000,
		500000,
		700000,
		900000,
		1000000,
		1500000,
		2000000,
		3000000,
		4000000,
		4500000,
		6000000,
		7000000,
		8000000,
		9000000,
		10000000,
		11000000,
		12000000,
		13000000,
		14000000,
		15000000,
		18000000,
		20000000,
		23000000,
		25000000,
		27000000,
		30000000,
		32000000,
		35000000,
		38000000,
		40000000,
		41000000,
		42000000,
		43000000,
		44000000,
		45000000,
		46000000,
		47000000,
		48000000,
		50000000
	];
	protected Player $player;
	/** @var int[] */
	protected array $data;

	public function __construct(Player $player, array $data){
		$this->player = $player;
		$this->data = $data;
	}

	public function getData() : array{
		return $this->data;
	}

	public function setData(array $data) : void{
		$this->data = $data;
	}

	public function addSkillExp(Skill $skill, int $exp) : void{
		$this->setSkillExp($skill, $this->getSkillExp($skill) + $exp);

		while($this->getSkillExp($skill) >= $this->getMaxExp($this->getSkillLevel($skill))){
			if($this->getSkillLevel($skill) < $this->getMaxLevel()){
				//LEVEL UP !
				$this->setSkillExp($skill, $this->getSkillExp($skill) - $this->getMaxExp($this->getSkillLevel($skill)));
				$this->setSkillLevel($skill, $this->getSkillLevel($skill) + 1);
			}
		}
	}

	public function setSkillExp(Skill $skill, int $exp) : void{
		$ev = new PlayerUpdateExpEvent($this->getPlayer(), $skill);
		$ev->call();
		if($ev->isCancelled()){
			return;
		}
		$this->data[$skill->getIdExp()] = $exp;
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getSkillExp(Skill $skill) : int{
		return $this->data[$skill->getIdExp()];
	}

	public function getMaxExp(int $level) : int{
		return self::MAX_EXP[$level];
	}

	public function getSkillLevel(Skill $skill) : int{
		return $this->data[$skill->getIdLevel()];
	}

	public function getMaxLevel() : int{
		return 60;
	}

	public function setSkillLevel(Skill $skill, int $level) : void{
		$this->data[$skill->getIdLevel()] = $level;
	}

}