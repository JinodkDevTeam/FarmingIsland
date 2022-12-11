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

class PlayerInfo extends BaseCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Show player infomation");
		$this->setPermission("gh.playerinfo");

		$this->registerArgument(0, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!isset($args["player"])){
			if(!$sender instanceof Player){
				$sender->sendMessage("/playerinfo <player>");
				return;
			}
			$player = $sender;
		}else{
			if(!$sender->hasPermission("gh.playerinfo.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		}
		if(is_null($player)){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
			return;
		}
		$this->showInfo($sender, $player);
	}

	public function showInfo(CommandSender $sender, Player $player){
		$pos = $player->getPosition();
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info1($player->getDisplayName())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info2((string)$pos->getX(), (string)$pos->getY(), (string)$pos->getZ())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info3($pos->getWorld()->getDisplayName())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info4($player->getName())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info5($player->getNetworkSession()->getIp())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info6((string)$player->getNetworkSession()->getPort())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info7((string)$player->getNetworkSession()->getPing())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info8($player->getLocale())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info9($player->getUniqueId()->toString())));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_pinfo_info10($player->getXuid())));
	}
}