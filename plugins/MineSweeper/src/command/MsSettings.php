<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command;

use CortexPE\Commando\args\BooleanArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\command\args\SettingsArgs;
use NgLam2911\MineSweeper\session\SessionManager;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class MsSettings extends BaseCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new SettingsArgs());
		$this->registerArgument(1, new BooleanArgument("value"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!$sender instanceof Player){
			$sender->sendMessage("Please run this command in game");
			return;
		}
		$session = SessionManager::getInstance()->getSession($sender->getName());
		if ($session === null){
			$sender->sendMessage("Something went wrong when getting your data");
			return;
		}
		$setting = $args["setting"];
		$value = $args["value"];
		switch($setting){
			case "autoFlag":
				$session->setAutoFlag($value);
				$sender->sendMessage("Auto flag is now " . ($value ? "enabled" : "disabled"));
				break;
			case "autoExplode":
				$session->setAutoExplode($value);
				$sender->sendMessage("Auto explode is now " . ($value ? "enabled" : "disabled"));
				break;
			case "recursiveExplode":
				$session->setRecursiveExplode($value);
				$sender->sendMessage("Recursive explode is now " . ($value ? "enabled" : "disabled"));
				break;
			default:
				$sender->sendMessage("Setting $setting does not exist");
				break;
		}
	}
}