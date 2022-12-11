<?php
declare(strict_types=1);

namespace Mail\ui;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class MailUI extends BaseUI{

	public function execute(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if(!isset($data)) return;
			switch($data){
				case 0:
					new CreateMailUI($this->getLoader(), $player, $this->getUsername());
					break;
				case 1:
					new SentMailsUI($this->getLoader(), $player, $this->getUsername());
					break;
				case 2:
					new MyMailsUI($this->getLoader(), $player, $this->getUsername());
					break;
			}
		});
		$form->setTitle(Lang::translate($player, TF::mail_ui_main_title()));
		$form->setContent(Lang::translate($player, TF::mail_ui_main_content($this->getUsername())));
		$form->addButton(Lang::translate($player, TF::mail_ui_main_button_create()));
		$form->addButton(Lang::translate($player, TF::mail_ui_main_button_sent()));
		$form->addButton(Lang::translate($player, TF::mail_ui_main_button_mymails()));

		$player->sendForm($form);
	}
}