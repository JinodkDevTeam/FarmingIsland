<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class Feed extends BaseCommand
{
    private Core $plugin;

    public function __construct(Core $plugin)
    {
        parent::__construct("feed");
        $this->plugin = $plugin;
        $this->setDescription("Fees command");
        $this->setPermission("gh.feed");
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
            if (!$sender->hasPermission("gh.feed.other"))
            {
                $sender->sendMessage("You not have permission to feed other player");
                return;
            }
            $player = Server::getInstance()->getPlayerByPrefix($args[0]);
            if (!isset($player))
            {
                $sender->sendMessage("Player not exist !");
                return;
            }
            $player->getHungerManager()->setFood(20);
            $sender->sendMessage($player->getName() . "have been fed");
            return;
        }
        if (!$sender->hasPermission("gh.feed.use"))
        {
            $sender->sendMessage("You not have permission to use this command");
            return;
        }
        $sender->getHungerManager()->setFood(20);
        $sender->sendMessage("You have been fed !");
    }
}
