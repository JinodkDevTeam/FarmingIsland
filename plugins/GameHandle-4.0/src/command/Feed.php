<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Feed extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Feed command");
		$this->setPermission("gh.feed");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.feed.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_feed_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			$player->getHungerManager()->setFood(20);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_feed_other_success($player->getName())));
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		$sender->getHungerManager()->setFood(20);
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_feed_success()));
	}
}
