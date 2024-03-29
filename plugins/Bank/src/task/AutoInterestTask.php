<?php
declare(strict_types=1);

namespace Bank\task;

use Bank\Bank;
use pocketmine\scheduler\Task;
use SOFe\AwaitGenerator\Await;

class AutoInterestTask extends Task{
	private Bank $bank;

	public function __construct(Bank $bank){
		$this->bank = $bank;
	}

	public function onRun() : void{
		$interest = (int) $this->getBank()->getConfig()->get("setting")["interest"];
		Await::f2c(function() use ($interest){
			$rows = yield $this->getBank()->getProvider()->getAll();
			foreach($rows as $row){
				$balance = (float) $row["Money"];
				$balance = $balance + round($balance * ($interest / 100), 2, PHP_ROUND_HALF_DOWN);
				$upgrade = (int) $row["Upgrade"];
				$max = $this->getBank()->getProvider()->getBankLimit($upgrade);
				if($balance > $max){
					$balance = $max;
				}
				$this->getBank()->getProvider()->updateBalance($row["Player"], $balance);
			}
		});
	}

	private function getBank() : Bank{
		return $this->bank;
	}
}