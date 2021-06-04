<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;

class FiVersion extends BaseCommand
{

    public string $version;

    public function __construct(Core $core)
    {
        $this->version = $core->getDescription()->getVersion();

        parent::__construct("fiversion");
        $this->setDescription("FarmingIsland Version");
        $this->setPermission("gh.fiver");
        $this->setAliases(["fiver", "fi-ver"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $sender->sendMessage("Server version: " . $this->version);
    }
}