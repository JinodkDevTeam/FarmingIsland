<?php
declare(strict_types=1);

namespace Bank\ui;

use Bank\Bank;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class WithdrawUI extends BaseUI
{
	public function execute(Player $player) : void
	{
		$form = new SimpleForm(function(Player $player, ?int $data)
		{
			//TODO: Handle withdraw
		});
		$form->setTitle("Bank withdraw");
		$form->addButton("Back");
		$form->addButton("Everything in the account");
		$form->addButton("Half the account");
		$form->addButton("Withdraw 20%");
		$form->addButton("Specific amount");

		$player->sendForm($form);
	}

	public function specificAmount(Player $player)
	{
		$form = new CustomForm(function(Player $player, ?array $data)
		{
			//TODO: Handle withdraw
		});

		$form->setTitle("Withdraw specific amount");
		$form->addInput("Amount:", "123456789");

		$player->sendForm($form);
	}
}