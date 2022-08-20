<?php
declare(strict_types=1);

namespace FavoriteIslands\provider;

use FavoriteIslands\Loader;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;

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

	public function init() : void{
		try{
			$this->database = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
				"sqlite" => "sqlite.sql"
			]);

			$this->database->executeGeneric(self::INIT);
		}catch(SqlError $error){
			$this->getLoader()->getLogger()->error($error->getMessage());
		}finally{
			$this->database->waitAll();
		}

	}

	public function close() : void{
		if(isset($this->database)) {
			$this->database->waitAll();
			$this->database->close();
		}
	}

	public function register(Player|string $player, int $x, int $z) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield $this->database->asyncInsert(self::REGISTER, [
			"player" => $player,
			"x" => $x,
			"z" => $z
		]);
	}

	public function selectPlayer(Player|string $player) : Generator{
		if($player instanceof Player) $player = $player->getName();
		return yield from $this->database->asyncSelect(self::SELECT_PLAYER, [
			"player" => $player
		]);
	}

	public function selectID(int $x, int $z) : Generator{
		return yield from $this->database->asyncSelect(self::SELECT_ID, [
			"x" => $x,
			"z" => $z
		]);
	}

	public function remove(Player|string $player, int $x, int $z) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield $this->database->asyncChange(self::REMOVE, [
			"player" => $player,
			"x" => $x,
			"z" => $z
		]);
	}
}