<?php
declare(strict_types=1);

namespace JinodkDevTeam\utils;

use pocketmine\network\mcpe\protocol\ToastRequestPacket;
use pocketmine\player\Player;

class PlayerUtils{
	public static function addToast(Player $player, string $title, string $body){
		$packet = ToastRequestPacket::create($title, $body);
		$player->getNetworkSession()->sendDataPacket($packet);
	}
}