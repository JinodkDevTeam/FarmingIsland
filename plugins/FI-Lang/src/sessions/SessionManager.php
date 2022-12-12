<?php
declare(strict_types=1);

namespace FILang\sessions;

use pocketmine\player\Player;

class SessionManager{
	/** @var Session[] */
	private static array $sessions = [];

	public static function getSession(Player $player) : ?Session{
		return self::$sessions[$player->getUniqueId()->toString()] ?? null;
	}

	public static function addSession(Player $player, Session $session) : void{
		self::$sessions[$player->getUniqueId()->toString()] = $session;
	}

	public static function removeSession(Player $player) : void{
		unset(self::$sessions[$player->getUniqueId()->toString()]);
	}
}