<?php
declare(strict_types=1);

namespace NgLam2911\lmao\command\subcmd;

use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\lmao\command\args\PlayerArgument;
use NgLam2911\lmao\Lmao;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class SilentChest extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setPermission("lmao.silentchest");
		$this->registerArgument(0, new PlayerArgument(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!isset($args["player"])){
			if (!$sender instanceof Player){
				$sender->sendMessage("Please this command in-game");
				return;
			}
			$player = $sender;
		} else {
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
		}
		if (is_null($player)){
			$sender->sendMessage("Invalid player name !");
			return;
		}
		$session = Lmao::getInstance()->getSessionManager()->getSession($player);
		if (is_null($session)){
			//I haz no idea about this
			return;
		}
		if ($session->isSilentChest()){
			$session->setSilentChest(false);
			$sender->sendMessage("Disabled SilentChest mode for " . $player->getName());
		} else {
			$session->setSilentChest();
			$sender->sendMessage("Enabled SilentChest mode for " . $player->getName());
		}

	}
}