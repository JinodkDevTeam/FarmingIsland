<?php
declare(strict_types=1);

namespace SkillLevel\event;

use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\SkillLevel;

class PlayerUpdateExpEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	protected Player $player;
	protected int $skill_id;

	public function __construct(Player $player, int $skill_id){
		parent::__construct($this->getSkillLevel());

		$this->player = $player;
		$this->skill_id = $skill_id;
	}

	private function getSkillLevel(): ?SkillLevel
	{
		$sl = Server::getInstance()->getPluginManager()->getPlugin("FI-SkillLevel");
		if ($sl instanceof SkillLevel)
		{
			return $sl;
		}
		return null;
	}

	public function getPlayer() : Player
	{
		return $this->player;
	}

	public function getSkillID(): int
	{
		return $this->skill_id;
	}
}