<?php
declare(strict_types=1);

namespace PlayerStat\command;

use PlayerStat\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class PlayerStatCommand extends Command implements PluginOwned{

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		// TODO: Implement execute() method.
	}

	public function getOwningPlugin() : Plugin{
		return Loader::getInstance();
	}
}