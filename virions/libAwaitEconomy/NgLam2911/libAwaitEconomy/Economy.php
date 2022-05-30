<?php
declare(strict_types=1);

namespace NgLam2911\libAwaitEconomy;

use Generator;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

interface Economy{

	public function init(Plugin $plugin): void;

	public function getMoney(Player $player): Generator;

	public function setMoney(Player $player, float $value): Generator;

	public function addMoney(Player $player, float $value): Generator;

	public function takeMoney(Player $player, float $value): Generator;

	//TODO: PAY
	//TODO: GetAllAccount
}