<?php
declare(strict_types=1);

namespace RankPrefix;

use CortexPE\HRKChat\event\PlaceholderResolveEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use RankPrefix\utils\UnicodeParser;

class Loader extends PluginBase implements Listener
{
	public array $prefix = [];

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function getPrefix(Player $player): string
	{
		if (!isset($this->prefix[$player->getName()])) return UnicodeParser::fromCode("E100");
		return match ($this->prefix[$player->getName()]) {
			"vip" => UnicodeParser::fromCode("E101"),
			"admin" => UnicodeParser::fromCode("E102"),
			"staff" => UnicodeParser::fromCode("E103"),
			"member" => UnicodeParser::fromCode("E104"),
			"youtuber", "ytber" => UnicodeParser::fromCode("E105"),
			"developer", "dev" => UnicodeParser::fromCode("E106"),
			"owner" => UnicodeParser::fromCode("E107"),
			"helper" => UnicodeParser::fromCode("E108"),
			"catlazy" => UnicodeParser::fromCode("E110"),
			"rgb" => UnicodeParser::fromCode("E111"),
			"nglam" => UnicodeParser::fromCode("E112"),
			"jinodk" => UnicodeParser::fromCode("E113"),
			"uwu" => UnicodeParser::fromCode("E114"),
			"wibu", "weeb", "weeeb" => UnicodeParser::fromCode("E115"),
			"simp" => UnicodeParser::fromCode("E116"),
			"lgbt", "lgbtq+" => UnicodeParser::fromCode("E117"),
			"campiole", "camp" => UnicodeParser::fromCode("E118"),
			default => UnicodeParser::fromCode("E100"),
		};
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