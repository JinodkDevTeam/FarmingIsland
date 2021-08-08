<?php
declare(strict_types=1);

namespace RankPrefix;

use CortexPE\HRKChat\event\PlaceholderResolveEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase implements Listener
{
	public array $prefix = [];

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function getPrefix(Player $player): string
	{
		if (!isset($this->prefix[$player->getName()])) return ""; //U+E100
		switch($this->prefix[$player->getName()])
		{
			case "vip":
				return ""; //U+E101
			case "admin":
				return ""; //U+E102
			case "staff":
				return ""; //U+E103
			case "member":
				return ""; //U+E104
			case "youtuber":
			case "ytber":
				return ""; //U+E105
			case "developer":
			case "dev":
				return ""; //U+E106
			case "owner":
				return ""; //U+E107
			case "helper":
				return ""; //U+E108
			case "catlazy":
				return ""; //U+E110
			case "rgb":
				return ""; //U+E111
			case "nglam":
				return ""; //U+E112
			case "jinodk":
				return ""; //U+E113
			case "player":
			default:
				return ""; //U+E100
		}
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
	{
		if ($command->getName() !== "prefix")
		{
			return true;
		}
		if (!$sender instanceof Player)
		{
			$sender->sendMessage("Please use in-game");
			return true;
		}
		if (isset($args[0]))
		{
			$this->prefix[$sender->getName()] = $args[0];
		}
		return true;
	}

	/**
	 * @param PlaceholderResolveEvent $event
	 * @priority NORMAL
	 * @handleCancelled FALSE
	 */
	public function onPlaceHolderResovle(PlaceholderResolveEvent $event)
	{
		if ($event->getPlaceholderName() === "prefix.rank")
		{
			$event->setValue($this->getPrefix($event->getMember()->getPlayer()));
		}
	}
}