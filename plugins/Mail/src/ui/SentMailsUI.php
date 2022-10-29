<?php
declare(strict_types=1);

namespace Mail\ui;

use jojoe77777\FormAPI\SimpleForm;
use Mail\Mail;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class SentMailsUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$mails_data = yield from $this->getLoader()->getProvider()->selectFrom($this->getUsername());
			if(empty($mails_data)){
				$player->sendMessage("You dont have any sended mails");
				return;
			}
			$form = new SimpleForm(function(Player $player, ?int $data) use ($mails_data){
				if(!isset($data)) return;
				$mail = Mail::fromArray($mails_data[$data]);
				new MailInfo($this->getLoader(), $player, $this->getUsername(), $mail->getId(), MailInfo::FROM);
			});
			foreach($mails_data as $mail_data){
				$mail = Mail::fromArray($mail_data);
				$form->addButton($mail->getTitle() . "\nTo: " . $mail->getTo());
			}
			$form->setTitle("Sended Mails");

			$player->sendForm($form);
		});
	}
}