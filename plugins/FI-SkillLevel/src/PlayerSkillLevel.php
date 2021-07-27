<?php

namespace SkillLevel;

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\event\PlayerUpdateExpEvent;

class PlayerSkillLevel{
	private Player $player;
	/** @var int[] */
	private array $data;

	public function __construct(Player $player, array $data){
		$this->player = $player;
		$this->data = $data;
	}

	public function getData() : array{
		return $this->data;
	}

	#[NoReturn]
	public function setData(array $data) : void{
		$this->data = $data;
		$this->update();
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	#[Pure]
	public function getSkillLevel(int $skill_code) : int{
		return $this->data[$this->IDLevelParser($skill_code)];
	}

	#[Pure]
	public function getSkillExp(int $skill_code) : int{
		return $this->data[$this->IDExpParser($skill_code)];
	}

	#[NoReturn]
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

	#[NoReturn]
	public function update()
	{
		$plugin = Server::getInstance()->getPluginManager()->getPlugin("FI-SKillLevel");
		if ($plugin instanceof SkillLevel)
		{
			$plugin->getPlayerSkillLevelManager()->registerPlayer($this->getPlayer(), $this->getData());
		}
	}

}