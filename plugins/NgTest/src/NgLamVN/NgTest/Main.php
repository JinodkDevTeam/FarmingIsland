<?php

declare(strict_types=1);

namespace NgLamVN\NgTest;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
	{
		if (!$sender instanceof Player) return true;
		if (strtolower($command->getName()) == "worldtp")
		{
			if (!isset($args[0])) return true;
			$worldName = $args[0];
			$worldManager = $this->getServer()->getWorldManager();

			if (!$worldManager->isWorldGenerated($worldName))
			{
				$sender->sendMessage("World not exist");
			}
			if (!$worldManager->isWorldLoaded($worldName))
			{
				$worldManager->loadWorld($worldName);
			}
			$world = $worldManager->getWorldByName($worldName);
			$sender->teleport($world->getSafeSpawn());
		}

		return true;
	}
}
