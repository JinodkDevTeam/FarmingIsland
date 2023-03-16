<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\session;

use pocketmine\player\Player;

class SessionManager{

	protected static SessionManager $instance;

	public static function getInstance() : SessionManager{
		return self::$instance ??= new SessionManager();
	}


	/** @var Session[] */
	protected array $sessions = [];

	public function getSession(Player|string $name) : ?Session{
		if ($name instanceof Player){
			$name = $name->getName();
		}
		return $this->sessions[$name] ?? null;
	}

	public function addSession(Session $session) : void{
		$this->sessions[$session->getName()] = $session;
	}

	public function removeSession(Player|Session|string $name) : void{
		if (($name instanceof Player) or ($name instanceof Session)){
			$name = $name->getName();
		}
		unset($this->sessions[$name]);
	}

	public function getSessions() : array{
		return $this->sessions;
	}
}