<?php
declare(strict_types=1);

namespace Bank\event;

use Bank\Bank;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\player\Player;
use pocketmine\Server;

class BankBalanceUpdateEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	public const TYPE_NONE = 0;
	public const TYPE_DEPOSIT = 1;
	public const TYPE_WITHDRAW = 2;

	protected Player|string $player;
	protected float $old_balance;
	protected float $new_balance;
	protected int $type;

	public function __construct(Player|string $player, float $old_balance, float $new_balance, int $type){
		parent::__construct($this->getBank());
		$this->player = $player;
		$this->old_balance = $old_balance;
		$this->new_balance = $new_balance;
		$this->type = $type;
	}

	private function getBank() : ?Bank{
		$bank = Server::getInstance()->getPluginManager()->getPlugin("Bank");
		if($bank instanceof Bank) return $bank;
		return null;
	}

	public function getPlayer() : Player|string{
		return $this->player;
	}

	public function getType() : int{
		return $this->type;
	}

	public function getOldBalance() : float{
		return $this->old_balance;
	}
	
	public function getNewBalance() : float{
		return $this->new_balance;
	}


}