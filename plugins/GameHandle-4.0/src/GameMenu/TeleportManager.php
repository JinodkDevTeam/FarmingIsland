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
			if(is_null($data)) return;
			if($data == 0) $this->FILobbyArea($player);
		});
		$form->setTitle("Fast Travel Menu");
		$form->addButton("§　§l§eFarmingIsland Lobby");
		$player->sendForm($form);
	}

	public function FILobbyArea(Player $player){
		$form = new SimpleForm(function(Player $player, $data){
		});
		$form->setTitle("FarmingIsland Lobby");
		$form->addButton("§　§l§6Village\n§7Comming Soon !");
		$form->addButton("§　§l§0Coal §4Mine\n§7Comming Soon !");
		$form->addButton("§　§l§6Gold §4Mine\n§7Comming Soon !");
		$form->addButton("§　§l§cNether\n§7Comming Soon !");
		$form->addButton("§　§l§dThe End\n§7Comming Soon !");
		$form->addButton("§　§l§0???\n§7Comming Soon !");
		$form->addButton("§　§l§0???\n§7Comming Soon !");
		$form->addButton("§　§l§0???\n§7Comming Soon !");
		$form->addButton("§　§l§0???\n§7Comming Soon !");
		$player->sendForm($form);
	}
}
