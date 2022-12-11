<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Mute extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Mute command");
		$this->setPermission("gh.mute");

		$this->registerArgument(0, new PlayerArgs());
		$this->registerArgument(1, new IntegerArgument("seconds", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		if(is_null($player)){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
			return;
		}
		$time = $args["seconds"] ?? PHP_INT_MAX;
		$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setMute(true, $time);
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_mute_success($player->getName(), (string)$time)));
		$player->sendMessage(Lang::translate($player, TF::gh_cmd_mute_targetnotice($sender->getName(), (string)$time)));
	}
}
