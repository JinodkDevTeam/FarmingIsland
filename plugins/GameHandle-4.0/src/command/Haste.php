<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\player\Player;
use pocketmine\Server;

class Haste extends BaseCommand
{
    public function __construct(Core $core)
    {
        parent::__construct($core, "haste");
        $this->setDescription("Haste Effect");
        $this->setPermission("gh.haste.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
		if (!$sender instanceof Player)
		{
			$sender->sendMessage("Please use this command in-game");
			return;
		}
        if (!isset($args[0]))
        {
            $sender->sendMessage("/haste <level (1-5)> <player>");
            return;
        }
        if (!is_integer($args[0]))
        {
            $sender->sendMessage("Level must be on integer type");
            return;
        }
        $level = $args[0];
        $effect = new EffectInstance(VanillaEffects::HASTE(), 99999999, $level, true);

        if (isset($args[1])) {
            if (!$sender->hasPermission("gh.haste.other")) {
                $sender->sendMessage("You not have permission to enable haste on other player");
                return;
            }
            $player = Server::getInstance()->getPlayerByPrefix($args[1]);
            if (!isset($player)) {
                $sender->sendMessage("Player not exist !");
                return;
            }
            if ($player->getEffects()->has(VanillaEffects::HASTE()))
            {
                $player->getEffects()->remove(VanillaEffects::HASTE());
                $sender->sendMessage("Disable haste on " . $player->getName());
                return;
            }
            $player->getEffects()->add($effect);
            $sender->sendMessage("Enable haste on " . $player->getName());
            return;
        }
        if (!$sender->hasPermission("gh.haste.use")) {
            $sender->sendMessage("You are not have permission to use this command");
            return;
        }

        if ($sender->getEffects()->has(VanillaEffects::HASTE()))
        {
            $sender->getEffects()->remove(VanillaEffects::HASTE());
            $sender->sendMessage("Haste Disabled !");
        }
        $sender->getEffects()->add($effect);
        $sender->sendMessage("Haste Enabled !");
    }
}

