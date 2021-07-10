<?php

namespace NgLamVN\SkillLevel;

use pocketmine\player\Player;

class PlayerSkillLevel
{
	private Player $player;

	private array $data;

	public function __construct(Player $player, array $data)
	{
		$this->player = $player;
		$this->data = $data;
	}

	public function getPlayer(): Player
	{
		return $this->player;
	}
}