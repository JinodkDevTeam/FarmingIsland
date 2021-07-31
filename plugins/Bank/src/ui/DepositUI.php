<?php
declare(strict_types=1);

namespace Bank\ui;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class DepositUI extends BaseUI
{
	public function execute(Player $player) : void
	{
		$form = new SimpleForm(function(Player $player, ?int $data)
		{
			//TODO: Handle Deposit
		});
		$form->setTitle("Bank deposit");
		$form->addButton("Back");
		$form->addButton("Your whole purse");
		$form->addButton("Half your purse");
		$form->addButton("Specific amount");

		$player->sendForm($form);
	}

	public function specificAmount(Player $player)
	{
		$form = new CustomForm(function(Player $player, ?array $data)
		{
			//TODO: Handle deposit
		});

		$form->setTitle("Deposit specific amount");
		$form->addInput("Amount:", "123456789");

		$player->sendForm($form);
	}
}