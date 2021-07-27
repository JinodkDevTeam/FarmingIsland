<?php
declare(strict_types=1);

namespace SkillLevel;

use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\event\PlayerUpdateExpEvent;

class PlayerSkillLevel{
	private Player $player;
	/** @var int[] */
	private array $data;

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
		$ev = new PlayerUpdateExpEvent($this->getPlayer(), $skill_code);
		$ev->call();
		if ($ev->isCancelled()) {
			return;
		}
		$this->data[$this->IDExpParser($skill_code)] = $exp;
		$this->update();
	}

	public function addSkillExp(int $skill_code, int $exp) : void{
		$this->setSkillExp($skill_code, $this->getSkillExp($skill_code) + $exp);

		while ($this->getSkillExp($skill_code) >= $this->getMaxExp($this->getSkillLevel($skill_code)))
		{
			//LEVEL UP !
			$this->setSkillExp($skill_code, $this->getSkillExp($skill_code) - $this->getMaxExp($this->getSkillLevel($skill_code)));
			$this->setSkillLevel($skill_code, $this->getSkillLevel($skill_code) + 1);
		}
	}

	public function getMaxExp(int $level): int
	{
		return self::MAX_EXP[$level];
	}

	public function getMaxLevel(): int
	{
		return 60;
	}

	public function IDLevelParser(int $code = 0) : string{
		return match ($code) {
			SkillLevel::MINING => "MiningLevel",
			SkillLevel::FISHING => "FishingLevel",
			SkillLevel::FARMING => "FarmingLevel",
			SkillLevel::FORAGING => "ForagingLevel",
			default => "",
		};
	}

	public function IDExpParser(int $code = 0) : string{
		return match ($code) {
			SkillLevel::MINING => "MiningExp",
			SkillLevel::FISHING => "FishingExp",
			SkillLevel::FARMING => "FarmingExp",
			SkillLevel::FORAGING => "ForagingExp",
			default => "",
		};
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