<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

abstract class IngameCommand extends BaseCommand{

	public final function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game !");
			return;
		}
		$this->handle($sender, $aliasUsed, $args);
	}

	public abstract function handle(Player $player, string $aliasUsed, array $args) : void;
}