<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\GameMenu\UpdateInfo;
use pocketmine\player\Player;

class Tutorial extends IngameCommand{
	protected function prepare() : void{
		$this->setDescription("View tutorial");
		$this->setPermission("gh.tutorial");
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		new UpdateInfo($player, "tutorial");
	}
}
