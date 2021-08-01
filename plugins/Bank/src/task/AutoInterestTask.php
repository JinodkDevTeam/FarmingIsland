<?php
declare(strict_types=1);

namespace Bank\task;

use Bank\Bank;
use pocketmine\scheduler\Task;
use SOFe\AwaitGenerator\Await;

class AutoInterestTask extends Task
{
	private Bank $bank;

	public const INTEREST = 2; //PERCENT;

	public function __construct(Bank $bank)
	{
		$this->bank = $bank;
	}

	private function getBank(): Bank
	{
		return $this->bank;
	}

	public function onRun() : void
	{
		Await::f2c(function()
		{
			$rows = yield $this->getBank()->getProvider()->getAll();
			foreach($rows as $row)
			{
				$balance = (float)$row["Money"];
				$balance = $balance + round($balance*(self::INTEREST/100), 2, PHP_ROUND_HALF_DOWN);
				$this->getBank()->getProvider()->update($row["Player"], $balance);
			}
		});
	}
}