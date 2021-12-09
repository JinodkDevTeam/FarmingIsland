<?php
declare(strict_types=1);

namespace PlayerStat\session;

use pocketmine\player\Player;

class SessionManager{

	/** @var PlayerSession[] */
	protected array $sessions = [];

	public function register(PlayerSession $session) : void{
		$this->sessions[$session->getPlayer()->getName()] = $session;
	}

	public function unregister(PlayerSession|Player|string $session) : void{
		if ($session instanceof PlayerSession){
			$session = $session->getPlayer()->getName();
		} elseif($session instanceof Player){
			$session = $session->getName();
		}
		if (isset($this->sessions[$session])){
			unset($this->sessions[$session]);
		}
	}

	public function get(Player|string $player) : ?PlayerSession{
		if($player instanceof Player){
			$player = $player->getName();
		}
		if (isset($this->sessions[$player])){
			return ($this->sessions[$player]);
		}
		return null;
	}

	/**
	 * @return PlayerSession[]
	 */
	public function getAll() : array{
		return array_values($this->sessions);
	}
}