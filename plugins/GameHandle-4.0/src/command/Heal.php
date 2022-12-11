<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Heal extends BaseCommand{

	protected function prepare() : void{
		$this->setDescription("Heal command");
		$this->setPermission("gh.heal");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.heal.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_heal_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			$player->setHealth(20);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_heal_other_success($player->getName())));
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		$sender->setHealth(20);
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_heal_success()));
	}
}
