<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use NgLamVN\GameHandle\GameMenu\UpdateInfo;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Tutorial extends LegacyBaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "tutorial");
		$this->setDescription("View tutorial");
		$this->setPermission("gh.tutorial");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game");
			return;
		}
		new UpdateInfo($sender, "tutorial");
	}
}
