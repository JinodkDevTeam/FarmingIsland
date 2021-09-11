<?php
declare(strict_types=1);

namespace Bank\ui;

use Bank\Bank;
use pocketmine\player\Player;

abstract class BaseUI{
	protected Bank $bank;

	public function __construct(Player $player, Bank $bank){
		$this->bank = $bank;
		$this->execute($player);
	}

	public function execute(Player $player) : void{ }

	protected function getBank() : Bank{
		return $this->bank;
	}
}