<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class TeleportManager{
	public function __construct(Player $player){
		$this->execute($player);
	}

	public function execute(Player $player){
		$form = new SimpleForm(function(Player $player, $data){
		});
		$form->setTitle("Teleport");
		$form->addButton("§　§l§cEXIT");
		$form->addButton("§　§lComming soon !");

		$player->sendForm($form);
	}
}
