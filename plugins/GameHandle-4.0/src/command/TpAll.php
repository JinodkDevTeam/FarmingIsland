<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class TpAll extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "tpall");
        $this->setDescription("TpAll command");
        $this->setPermission("gh.tpall");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
		if (!$sender->hasPermission("gh.tpall"))
		{
			$sender->sendMessage("You not have permission to use this command");
			return;
		}
		if (isset($args[0]))
        {
			$player = Server::getInstance()->getPlayerByPrefix($args[0]);
            if (!isset($player))
            {
                $sender->sendMessage("Player not exist !");
                return;
            }
            foreach (Server::getInstance()->getOnlinePlayers() as $players)
            {
                $players->teleport($player->getPosition());
            }
            $sender->sendMessage("All players have been teleported to ". $player->getName());
            return;
        }
		if (!$sender instanceof Player)
		{
			$sender->sendMessage("/tpall <player>");
			return;
		}
        $player = $sender;
        foreach (Server::getInstance()->getOnlinePlayers() as $players)
        {
            $players->teleport($player->getPosition());
        }
        $sender->sendMessage("All player have been teleported to you");
    }
}