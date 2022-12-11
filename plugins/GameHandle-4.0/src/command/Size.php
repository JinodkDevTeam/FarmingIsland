<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class Size extends BaseCommand{

	public const MIN_SIZE = 0.05; //Prevent server freeze
	public const MAX_SIZE = 10; //Prevent client lag
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setPermission("gh.size.use");
		$this->setDescription("Change your size, default is 1");
		$this->setUsage("/size <size>");

		$this->registerArgument(0, new FloatArgument("size", false));
		$this->registerArgument(1, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if($args["size"] < self::MIN_SIZE){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_size_toosmall((string)self::MIN_SIZE)));
			return;
		}
		if($args["size"] > self::MAX_SIZE){
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_size_toolarge((string)self::MAX_SIZE)));
			return;
		}
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.size.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_size_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			$player->setScale($args["size"]);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_size_other_success($player->getName(), (string)$args["size"])));
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		$sender->setScale($args["size"]);
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_size_success((string)$args["size"])));
	}
}