<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Sell extends BaseCommand
{
    public Core $plugin;

    public function __construct(Core $plugin)
    {
        parent::__construct("sell");
        $this->plugin = $plugin;
        $this->setDescription("Sell items in your inventory");
        $this->setPermission("gh.sell.use");
    }

    public function getCore(): Core
    {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender->hasPermission("gh.sell.use"))
        {
            return;
        }
        if (!$sender instanceof Player)
		{
			return;
		}
        if (!isset($args[0]))
        {
            $sender->sendMessage("/sell <hand|all>");
            return;
        }
        switch ($args[0])
        {
            case "hand":
                $this->getCore()->getSellHandler()->sellHand($sender);
                break;
            case "all":
            	$this->getCore()->getSellHandler()->sellAll($sender);
                break;
			case "undo":
				$this->getCore()->getSellHandler()->undo($sender);
        }
    }
}
