<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\BlockPositionArgument;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\AreaManager;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\world\Position;

class SetPlayPosArea extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("area"));
		$this->registerArgument(1, new BlockPositionArgument("position", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if (!$sender instanceof Player){
			$sender->sendMessage("Please run this command in game");
			return;
		}
		$areaName = $args["area"];
		$pos = $args["position"] ?? $sender->getPosition();
		$pos = new Position($pos->x, $pos->y, $pos->z, $sender->getWorld());
		$area = AreaManager::getInstance()->getArea($areaName);
		if ($area === null){
			$sender->sendMessage("Area $areaName does not exist");
			return;
		}
		$area->setGamePos($pos);
		$sender->sendMessage("Set game position for area $areaName to $pos->x $pos->y $pos->z in world {$pos->getWorld()->getDisplayName()}");
	}
}