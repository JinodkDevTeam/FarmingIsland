<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\AreaManager;
use NgLam2911\MineSweeper\command\args\PlayerArgs;
use NgLam2911\MineSweeper\session\SessionManager;
use pocketmine\command\CommandSender;

class AddPlayerArea extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("area"));
		$this->registerArgument(1, new PlayerArgs("player"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$areaName = $args["area"];
		$playerName = $args["player"];
		$area = AreaManager::getInstance()->getArea($areaName);
		if ($area === null){
			$sender->sendMessage("Area $areaName does not exist");
			return;
		}
		$session = SessionManager::getInstance()->getSession($playerName);
		if ($session === null){
			$sender->sendMessage("Player $playerName does not exist");
			return;
		}
		$area->addPlayer($session);
	}
}