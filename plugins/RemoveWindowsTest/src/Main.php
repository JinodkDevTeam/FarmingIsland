<?php
declare(strict_types=1);

namespace RemoveWindowTest;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if ($command->getName() === "remove"){
			if (!isset($args[0])){
				return true;
			}
			$this->getServer()->getPlayerByPrefix($args[0])?->removeCurrentWindow();
		}
		return true;
	}
}