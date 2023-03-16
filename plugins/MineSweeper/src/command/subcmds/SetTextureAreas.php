<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\subcmds;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLam2911\MineSweeper\area\AreaManager;
use NgLam2911\MineSweeper\area\texture\AreaTextures;
use NgLam2911\MineSweeper\command\args\AreaTextureArgs;
use pocketmine\command\CommandSender;

class SetTextureAreas extends BaseSubCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->registerArgument(0, new RawStringArgument("area"));
		$this->registerArgument(1, new AreaTextureArgs());
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$areaName = $args["area"];
		$area = AreaManager::getInstance()->getArea($areaName);
		if ($area === null){
			$sender->sendMessage("Area $areaName does not exist");
			return;
		}
		$texture = AreaTextures::fromString($args["texture"]);
		if ($texture === null){
			$sender->sendMessage("Texture {$args["texture"]} does not exist");
			return;
		}
		$area->setTexture($texture);
		$sender->sendMessage("Set texture of area $areaName to {$args["texture"]}");
	}
}