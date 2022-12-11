<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\SimpleForm;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

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
			Lang::translate($player, TF::gh_updateinfo_ui_content_wiki()),
			Lang::translate($player, TF::gh_updateinfo_ui_content_vote()),
			Lang::translate($player, TF::gh_updateinfo_ui_content_fbgroup()),
			Lang::translate($player, TF::gh_updateinfo_ui_content_version(Core::VERSION, Core::CODE_NAME))
		];
		$form->setTitle(Lang::translate($player, TF::gh_updateinfo_ui_title()));
		$form->setContent(implode(PHP_EOL, $text));
		$form->addButton(Lang::translate($player, TF::gh_updateinfo_ui_button_close()));
		$form->addButton(Lang::translate($player, TF::gh_updateinfo_ui_button_tutorial()));

		$player->sendForm($form);
	}

	public function TutorialForm(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			$this->WarningForm($player);
		});
		$form->setTitle(Lang::translate($player, TF::gh_updateinfo_tutorial_ui_title()));
		$form->setContent(Lang::translate($player, TF::gh_updateinfo_tutorial_ui_content()));
		$form->addButton(Lang::translate($player, TF::gh_updateinfo_tutorial_ui_button_close()));

		$player->sendForm($form);
	}

	public function WarningForm(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			//NOTHING
		});
		$form->setTitle(Lang::translate($player, TF::gh_updateinfo_warning_title()));
		$form->setContent(Lang::translate($player, TF::gh_updateinfo_warning_content()));
		$form->addButton(Lang::translate($player, TF::gh_updateinfo_warning_button_close()));

		$player->sendForm($form);
	}
}
