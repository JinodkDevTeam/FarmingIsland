<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Heal extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "heal");
        $this->setDescription("Heal command");
        $this->setPermission("gh.heal");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
		if (!$sender instanceof Player)
		{
			$sender->sendMessage("Please use this command in-game");
			return;
		}
        if (isset($args[0]))
        {
            if (!$sender->hasPermission("gh.heal.other"))
            {
                $sender->sendMessage("You not have permission to heal other player");
                return;
            }
            $player = Server::getInstance()->getPlayerByPrefix($args[0]);
            if (!isset($player))
            {
                $sender->sendMessage("Player not exist !");
                return;
            }
            $player->setHealth(20);
            $sender->sendMessage($player->getName() . "have been healed");
            return;
        }
        if (!$sender->hasPermission("gh.heal.use"))
        {
            $sender->sendMessage("You not have permission to use this command");
            return;
        }
        $sender->setHealth(20);
        $sender->sendMessage("You have been healed !");
    }
}
