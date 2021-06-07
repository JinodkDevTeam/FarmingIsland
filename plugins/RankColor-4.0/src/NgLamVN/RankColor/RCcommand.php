<?php

namespace NgLamVN\RankColor;

use NgLamVN\RankColor\forms\Member;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use NgLamVN\RankColor\forms\Vip;
use NgLamVN\RankColor\forms\Admin;
use NgLamVN\RankColor\forms\Staff;
use NgLamVN\RankColor\forms\VipPlus;
use NgLamVN\RankColor\forms\Youtuber;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class RCcommand extends Command implements PluginOwned
{
	use PluginOwnedTrait;
    public RankColor $plugin;

    public function __construct(RankColor $plugin)
    {
        $this->plugin = $plugin;
        parent::__construct("rankcolor");
        $this->setPermission("rc.command");
        $this->setDescription("RankColor Manager");
        $this->setAliases(["rc", "rcolor"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
    	if (!$sender instanceof Player)
		{
			return;
		}
        $group = $this->plugin->getPPgroupname($sender);
        switch ($group)
        {
            case "Vip":
                return new Vip($this->plugin, $sender);
                break;
            case "VipPlus":
                return new VipPlus($this->plugin, $sender);
                break;
            case "Staff":
                return new Staff($this->plugin, $sender);
                break;
            case "Youtuber":
                return new Youtuber($this->plugin, $sender);
                break;
            case "Admin":
                return new Admin($this->plugin, $sender);
                break;
            case "Member":
                return new Member($this->plugin, $sender);
            default:
                $sender->sendMessage("Change Color is not available for your rank !");
                break;
        }
        return;
    }
}