<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\Area;
use NgLam2911\MineSweeper\area\AreaManager;
use NgLam2911\MineSweeper\session\SessionManager;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CreateArea extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("areaName"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!$sender instanceof Player){
			$sender->sendMessage("Please run this command in game");
			return;
		}
		$areaName = $args["areaName"];
		$session = SessionManager::getInstance()->getSession($sender);
		if ($session === null){
			$sender->sendMessage("Failed to create an area");
			return;
		}
		if (AreaManager::getInstance()->getArea($areaName) !== null){
			$sender->sendMessage("An area with name $areaName already exists");
			return;
		}
		$area = new Area($areaName, $session);
		$area->addPlayer($session);
		AreaManager::getInstance()->addArea($area);
		$sender->sendMessage("Created an area with name $areaName");
	}
}