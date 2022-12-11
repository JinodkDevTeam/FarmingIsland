<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use Exception;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class UnMute extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("UnMute command");
		$this->setPermission("gh.unmute");

		$this->registerArgument(0, new PlayerArgs());
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		if(is_null($player)){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
			return;
		}
		try{
			$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setMute(false);
		}catch(Exception){
			$sender->sendMessage("PlayerStat Data Error !");
			return;
		}
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_unmute_success($player->getName())));
		$player->sendMessage(Lang::translate($player, TF::gh_cmd_unmute_targetnotice()));
	}
}
