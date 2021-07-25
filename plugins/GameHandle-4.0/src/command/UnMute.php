<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use Exception;
use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class UnMute extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "unmute");
        $this->setDescription("UnMute command");
        $this->setPermission("gh.unmute");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0]))
        {
            if (!$sender->hasPermission("gh.unmute"))
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
				$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setMute(false);
			}
            catch(Exception $e)
			{
				$sender->sendMessage("PlayerStat Data Error !");
				return;
			}
			$sender->sendMessage("Unmuted " .$player->getName(). " !");
            $player->sendMessage("You have been unmuted !");
            return;
        }
        $sender->sendMessage("/unmute <player>");
    }
}
