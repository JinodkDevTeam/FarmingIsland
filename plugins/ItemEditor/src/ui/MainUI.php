<?php
declare(strict_types=1);

namespace ItemEditor\ui;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class MainUI extends BaseUI{

	protected function execute(Player $player){
		$form = new SimpleForm(function(Player $player, ?int $data){

		});
		$form->setTitle("Item Editor");
		$form->addButton("Edit item name");
		$form->addButton("Edit item lores");
		$form->addButton("Edit item enchants");
		$form->addButton("Edit other item properties");
		$form->addButton("Edit item NBT");
		$form->addButton("Dupe item");

		$player->sendForm($form);
	}
}