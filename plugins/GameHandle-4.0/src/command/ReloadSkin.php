<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;

class ReloadSkin extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "reloadskin");
        $this->setDescription("Reload All Player Skin");
        $this->setPermission("gh.reloadskin");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender->hasPermission("gh.reloadskin"))
        {
            $sender->sendMessage("You not have permission to use this command !");
            return;
        }

        foreach ($this->getCore()->getServer()->getOnlinePlayers() as $player)
        {
            $player->setSkin($this->getCore()->skin[$player->getName()]);
        }
        $sender->sendMessage("All Player Skin reloaded !");
    }
}