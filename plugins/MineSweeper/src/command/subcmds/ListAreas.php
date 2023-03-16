<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\BaseSubCommand;
use NgLam2911\MineSweeper\area\AreaManager;
use pocketmine\command\CommandSender;

class ListAreas extends BaseSubCommand{

	protected function prepare() : void{
		//Nothing
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		foreach(AreaManager::getInstance()->getAreas() as $area){
			$sender->sendMessage(" - " . $area->getName() . " (owner: " . $area->getOwner()->getName() . ")");
		}
	}
}