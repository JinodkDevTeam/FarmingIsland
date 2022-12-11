<?php
declare(strict_types=1);

namespace Mail\ui;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use jojoe77777\FormAPI\SimpleForm;
use Mail\Mail;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class SentMailsUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$mails_data = yield from $this->getLoader()->getProvider()->selectFrom($this->getUsername());
			if(empty($mails_data)){
				$player->sendMessage(Lang::translate($player, TF::mail_nothavesent()));
				return;
			}
			$form = new SimpleForm(function(Player $player, ?int $data) use ($mails_data){
				if(!isset($data)) return;
				$mail = Mail::fromArray($mails_data[$data]);
				new MailInfo($this->getLoader(), $player, $this->getUsername(), $mail->getId(), MailInfo::FROM);
			});
			foreach($mails_data as $mail_data){
				$mail = Mail::fromArray($mail_data);
				$form->addButton(Lang::translate($player, TF::mail_ui_sent_button($mail->getTitle(), $mail->getTo())));
			}
			$form->setTitle(Lang::translate($player, TF::mail_ui_sent_title()));

			$player->sendForm($form);
		});
	}
}