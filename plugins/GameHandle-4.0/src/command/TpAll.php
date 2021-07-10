<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class TpAll extends BaseCommand
{
    private Core $plugin;

    public function __construct(Core $plugin)
    {
        parent::__construct("tpall");
        $this->plugin = $plugin;
        $this->setDescription("TpAll command");
        $this->setPermission("gh.tpall");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0]))
        {
            if (!$sender->hasPermission("gh.tpall"))
            {
                $sender->sendMessage("You not have permission to use this command");
                return;
            }
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
        if (!$sender->hasPermission("gh.tpall"))
        {
            $sender->sendMessage("You not have permission to use this command");
            return;
        }
        $player = $sender;
        foreach (Server::getInstance()->getOnlinePlayers() as $players)
        {
            $players->teleport($player);
        }
        $sender->sendMessage("All player have been teleported to you");
    }
}