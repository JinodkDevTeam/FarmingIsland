<?php
declare(strict_types=1);

namespace SkillLevel\event;

use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\Skill;
use SkillLevel\SkillLevel;

class PlayerUpdateExpEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	protected Player $player;
	protected Skill $skill;

	public function __construct(Player $player, Skill $skill){
		parent::__construct($this->getSkillLevel());

		$this->player = $player;
		$this->skill = $skill;
	}

	private function getSkillLevel() : ?SkillLevel{
		$sl = Server::getInstance()->getPluginManager()->getPlugin("FI-SkillLevel");
		if($sl instanceof SkillLevel){
			return $sl;
		}
		return null;
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getSkill() : Skill{
		return $this->skill;
	}
}