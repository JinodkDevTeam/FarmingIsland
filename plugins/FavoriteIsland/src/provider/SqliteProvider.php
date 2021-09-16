<?php
declare(strict_types=1);

namespace FavoriteIslands\provider;

use FavoriteIslands\Loader;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected const INIT = "fai.init";
	protected const REGISTER = "fai.register";
	protected const REMOVE = "fai.remove";
	protected const SELECT_PLAYER = "fai.select.player";
	protected const SELECT_ID = "fai.select.id";

	protected DataConnector $database;
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	protected function asyncSelect(string $query, array $args) : Generator{
		$this->database->executeSelect($query, $args, yield, yield Await::REJECT);
		return yield Await::ONCE;
	}

	public function init() : void{
		$this->database = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);

		$this->database->executeGeneric(self::INIT);
	}

	public function close() : void{
		if (isset($this->database)) $this->database->close();
	}

	public function register(Player|string $player, int $x, int $z) : void{
		if($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::REGISTER, [
			"player" => $player,
			"x" => $x,
			"z" => $z
		]);
	}

	public function selectPlayer(Player|string $player) : Generator{
		if($player instanceof Player) $player = $player->getName();
		return $this->asyncSelect(self::SELECT_PLAYER, [
			"player" => $player
		]);
	}

	public function selectID(int $x, int $z) : Generator{
		return $this->asyncSelect(self::SELECT_PLAYER, [
			"x" => $x,
			"z" => $z
		]);
	}

	public function remove(Player|string $player, int $x, int $z) : void{
		if($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::REMOVE, [
			"player" => $player,
			"x" => $x,
			"z" => $z
		]);
	}
}