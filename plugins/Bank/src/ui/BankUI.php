<?php
declare(strict_types=1);

namespace Bank\ui;

use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BankUI extends BaseUI
{
	public function execute(Player $player) : void
	{
		Await::f2c(function() use ($player)
		{
			$data = yield $this->getBank()->getProvider()->get($player);
			if (empty($data))
			{
				$player->sendMessage("Can't get data form database. Please report this error to admin !");
				return;
			}
			$balance = $data[0]["Money"];
			$purse = EconomyAPI::getInstance()->myMoney($player);
			$form = new SimpleForm(function(Player $player, ?int $data)
			{
				//TODO: Implement Handle System.
			});

			$form->setTitle("Personal Bank Account");
			$form->setContent("Current balance: " . $balance . PHP_EOL . "Your purse: " . $purse);
			$form->addButton("Deposit coins");
			$form->addButton("Withdraw coins");

			$player->sendForm($form);
		});
	}
}