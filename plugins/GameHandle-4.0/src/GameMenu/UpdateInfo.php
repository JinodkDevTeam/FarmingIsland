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

	public function execute(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if($data == 1){
				$this->TutorialForm($player);
			}else{
				$this->WarningForm($player);
			}
		});
		$text = [
			"§　Updates:",
			"- Update server to MCBE 1.19.0",
			"Official wiki: bit.ly/fi-wiki",
			"Vote for server: bit.ly/fi-vote",
			"Official Facebook group: bit.ly/jinodkgroupfb",
			"Server Version: " . Core::VERSION . " [" . Core::CODE_NAME . "]"
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
			$this->WarningForm($player);
		});
		$form->setTitle("§　§lTutorial");
		$form->setContent(implode(PHP_EOL, $text));
		$form->addButton("§　§lOK, LET'S PLAY !");

		$player->sendForm($form);
	}

	public function WarningForm(Player $player) : void{
		$text = [
			"* Currenly, this server is in development, every player data may be reseted by some reason. Just for testing.",
			"",
			"* Hiện tại server đang trong giai đoạn phát triển, do đó dữ liệu người chơi có thể bị reset bất cứ lúc nào với nhiều lý do, do đó cần cân nhắc khi chơi ở thời điểm này."
		];
		$form = new SimpleForm(function(Player $player, ?int $data){
			//NOTHING
		});
		$form->setTitle("§　§lWARNING");
		$form->setContent(implode(PHP_EOL, $text));
		$form->addButton("§　§lI know what i am doing !");

		$player->sendForm($form);
	}
}
