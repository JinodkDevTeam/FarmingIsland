<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\BooleanArgument;
use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\AreaManager;
use NgLam2911\MineSweeper\area\Board;
use pocketmine\command\CommandSender;

class SetBoard extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("area"));
		$this->registerArgument(1, new IntegerArgument("width"));
		$this->registerArgument(2, new IntegerArgument("height"));
		$this->registerArgument(3, new IntegerArgument("mines"));
		$this->registerArgument(4, new BooleanArgument("safeArea", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$areaName = $args["area"];
		$width = $args["width"];
		$height = $args["height"];
		$mines = $args["mines"];
		$safeArea = $args["safeArea"] ?? true;
		$area = AreaManager::getInstance()->getArea($areaName);
		if ($area === null){
			$sender->sendMessage("Area $areaName does not exist");
			return;
		}
		if ($area->getGamePos() === null){
			$sender->sendMessage("Please set the game position first");
			return;
		}
		$area->setBoard(new Board($width, $height, $mines, $safeArea));
	}
}