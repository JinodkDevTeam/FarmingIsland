<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

abstract class IngameCommand extends BaseCommand{

	public final function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		$this->handle($sender, $aliasUsed, $args);
	}

	public abstract function handle(Player $player, string $aliasUsed, array $args) : void;
}