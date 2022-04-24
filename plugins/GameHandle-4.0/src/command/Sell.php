<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\SellOptionsArgs;
use pocketmine\player\Player;

class Sell extends IngameCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Sell items in your inventory");
		$this->setPermission("gh.sell");

		$this->registerArgument(0, new SellOptionsArgs());
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		switch($args["SellOptions"]){
			case "hand":
				$this->getCore()->getSellHandler()->sellHand($player);
				break;
			case "all":
				$this->getCore()->getSellHandler()->sellAll($player);
				break;
			case "undo":
				$this->getCore()->getSellHandler()->undo($player);
		}
	}
}
