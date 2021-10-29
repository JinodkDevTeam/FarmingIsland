<?php
declare(strict_types=1);

namespace Backpack\provider;

use Backpack\Loader;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected DataConnector $database;
	protected Loader $loader;

	protected const INIT = "backpack.init";
	protected const REGISTER = "backpack.register";
	protected const REMOVE_ALL = "backpack.remove.all";
	protected const REMOVE_SLOT = "backpack.remove.slot";
	protected const UPDATE = "backpack.update";
	protected const SELECT_ALL = "backpack.select.all";
	protected const SELECT_PLAYER = "backpack.select.player";
	protected const SELECT_SLOT = "backpack.select.slot";


	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	protected function asyncSelect(string $query, array $args = []) : Generator{
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

	public function register(Player|string $player, int $slot = 0, string $data = "") : void{
		if ($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::REGISTER, [
			"player" => $player,
			"slot" => $slot,
			"data" => $data
		]);
	}

	public function removeAll(Player|string $player) : void{
		if ($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::REMOVE_ALL, [
			"player" => $player
		]);
	}

	public function removeSlot(Player|string $player, int $slot = 0) : void{
		if ($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::REMOVE_SLOT, [
			"player" => $player,
			"slot" => $slot
		]);
	}

	public function update(Player|string $player, int $slot = 0, string $data = ""){
		if ($player instanceof Player) $player = $player->getName();
		$this->database->executeChange(self::UPDATE, [
			"player" => $player,
			"slot" => $slot,
			"data" => $data
		]);
	}

	public function selectAll() : Generator{
		return $this->asyncSelect(self::SELECT_ALL);
	}

	public function selectPlayer(Player|string $player) : Generator{
		if ($player instanceof Player) $player = $player->getName();
		return $this->asyncSelect(self::SELECT_PLAYER, [
			"player" => $player
		]);
	}

	public function selectSlot(Player|string $player, int $slot) : Generator{
		if ($player instanceof Player) $player = $player->getName();
		return $this->asyncSelect(self::SELECT_SLOT, [
			"player" => $player,
			"slot" => $slot
		]);
	}
}