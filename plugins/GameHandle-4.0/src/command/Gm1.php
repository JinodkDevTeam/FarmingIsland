<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Gm1 extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Game mode command");
		$this->setPermission("gh.gm1");
		$this->setAliases(["gmc", "creative"]);

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.gm1.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_gamemode_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			$player->setGamemode(GameMode::CREATIVE());
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_gamemode_other_success($player->getName(), "creative")));
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_gamemode_addname()));
			return;
		}
		$sender->setGamemode(GameMode::CREATIVE());
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_gamemode_success("creative")));
	}
}