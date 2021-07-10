<?php

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;

abstract class BaseCommand extends Command implements PluginOwned
{
	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		//NOTHING.
	}

	public function getOwningPlugin() : Core{
		return Core::getInstance();
	}
}