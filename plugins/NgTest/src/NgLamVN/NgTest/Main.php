<?php

declare(strict_types=1);

namespace NgLamVN\NgTest;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\block\Block;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\world\Position;

class Main extends PluginBase implements Listener
{
	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$worlds = Server::getInstance()->getWorldManager()->getWorlds();
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
	{
		if (strtolower($command->getName()) == "worldtp")
		{
			if (!isset($args[0])) return true;
			$world = Server::getInstance()->getWorldManager()->getWorldByName($args[0]);


			if (is_null($world)) return true;
			if ($sender instanceof Player)
			{
				$sender->teleport();
			}
		}

		return true;
	}
}
