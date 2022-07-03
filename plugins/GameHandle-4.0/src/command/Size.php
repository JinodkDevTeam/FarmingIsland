<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

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
			$sender->sendMessage("This size cannot be smaller than " . self::MIN_SIZE);
			return;
		}
		if($args["size"] > self::MAX_SIZE){
			$sender->sendMessage("This size must not bigger than " . self::MAX_SIZE);
			return;
		}
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.size.other")){
				$sender->sendMessage("You don't have permission to set other player's size");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			$player->setScale($args["size"]);
			$sender->sendMessage("You have changed " . $player->getName() . "'s size to " . $args["size"]);
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game");
			return;
		}
		$sender->setScale($args["size"]);
		$sender->sendMessage("You have changed your size to " . $args["size"]);
	}
}