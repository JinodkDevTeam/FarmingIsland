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

class Fly extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Fly command");
		$this->setPermission("gh.fly");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.fly.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fly_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(!isset($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isFly()){
				$this->setFly($player, true);
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fly_other_enable($player->getName())));
			}else{
				$this->setFly($player, false);
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fly_other_disable($player->getName())));
			}
			return;
		}
		if(!($sender instanceof Player)){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		if(!$this->getCore()->getPlayerStatManager()->getPlayerStat($sender)->isFly()){
			$this->setFly($sender, true);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fly_enable()));
		}else{
			$this->setFly($sender, false);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fly_disable()));
		}
	}

	protected function setFly(Player $player, bool $status) : bool{
		$player->setAllowFlight($status);
		$player->setFlying($status);
		$stat = $this->getCore()->getPlayerStatManager()->getPlayerStat($player);
		if (is_null($stat)){
			return false;
		}
		$stat->setFly($status);
		return true;
	}
}
