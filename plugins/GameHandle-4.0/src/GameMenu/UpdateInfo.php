<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\SimpleForm;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;

class UpdateInfo{
	public function __construct(Player $player, string $mode = ""){
		if($mode == "") $this->execute($player);
		else $this->TutorialForm($player);
	}

	public function execute(Player $player){
		$form = new SimpleForm(function(Player $player, ?int $data){
			if($data == null) return;
			if($data == 1) $this->TutorialForm($player);
		});
		$text = [
			"§　Updates:",
			"- Welcome to API 4.0.0 branch for FarmingIslandServer",
			"- This server is for testing only",
			"- View changelogs at fiv2-dev-news channel at discord.",
			"Official wiki: bit.ly/fi-wiki",
			"Vote for server: bit.ly/fi-vote",
			"Official Facebook group: bit.ly/jinodkgroupfb",
			"Server Version: " . Core::VERSION . " build " . Core::BUILD_NUMBER
		];
		$form->setTitle("§　BREAKING NEWS");
		$form->setContent(implode(PHP_EOL, $text));
		$form->addButton("§　§lOK");
		$form->addButton("§　§lTutorial\nXem cách chơi.");

		$player->sendForm($form);
	}

	public function TutorialForm(Player $player){
		$text = [
			"Hướng dẫn sẽ được cập nhật khi máy chủ hoàn thiện.",
			"Tutorial will be updated when the server is completed"
		];
		$form = new SimpleForm(function(Player $player, ?int $data){
			//NOTHING
		});
		$form->setTitle("§　§lTutorial");
		$form->setContent(implode(PHP_EOL, $text));
		$form->addButton("§　§lOK, LEST PLAY !");

		$player->sendForm($form);
	}
}
