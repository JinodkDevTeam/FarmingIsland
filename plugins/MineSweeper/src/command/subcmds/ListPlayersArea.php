<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\AreaManager;
use pocketmine\command\CommandSender;

class ListPlayersArea extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("area"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$areaName = $args["area"];
		$area = AreaManager::getInstance()->getArea($areaName);
		if ($area === null){
			$sender->sendMessage("Area $areaName does not exist");
			return;
		}
		$players = $area->getPlayers();
		$sender->sendMessage("List players in area $areaName: ");
		foreach ($players as $player){
			$sender->sendMessage(" - " . $player->getPlayer()->getName() . ($area->getOwner() === $player)?" (owner)" : "");
		}
	}
}