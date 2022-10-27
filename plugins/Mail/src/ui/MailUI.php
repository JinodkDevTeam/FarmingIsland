<?php
declare(strict_types=1);

namespace Mail\ui;

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
		$form->setTitle("Mail");
		$form->setContent("Username: " . $this->getUsername());
		$form->addButton("Create new mail");
		$form->addButton("Sended mails");
		$form->addButton("My mails");

		$player->sendForm($form);
	}
}