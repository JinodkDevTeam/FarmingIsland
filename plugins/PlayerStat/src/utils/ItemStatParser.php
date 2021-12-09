<?php
declare(strict_types=1);

namespace PlayerStat\utils;

use PlayerStat\Loader;
use pocketmine\item\Item;
use pocketmine\player\Player;

class ItemStatParser{

	public static function parse(Item $item, Player $player){
		$stat = Loader::getInstance()->getSessionManager()->get($player);
		if ($stat === null){
			Loader::getInstance()->getLogger()->error("Something is wrong when parse item data in player " . $player->getName());
			return;
		}
		$nbt = $item->getNamedTag();
		if ($nbt->getTag("health") !== null){
			$health = (float)$nbt->getTag("health")->getValue();
		}
	}
}