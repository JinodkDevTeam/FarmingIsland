<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use Exception;
use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class UnFreeze extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "unfreeze");
        $this->setDescription("UnFreeze command");
        $this->setPermission("gh.unfreeze");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0]))
        {
            if (!$sender->hasPermission("gh.unfreeze"))
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

			try
			{
				$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setFreeze(false);
			}
            catch(Exception $e)
			{
				$sender->sendMessage("PlayerStat Data Error !");
				return;
			}
			$sender->sendMessage("Unfreeze " .$player->getName(). " !");
            $player->sendMessage("You have been unfreeze !");
            return;
        }
        $sender->sendMessage("/unfreeze <player>");
    }
}
