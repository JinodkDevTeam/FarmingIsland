<?php
declare(strict_types=1);

namespace Mail\ui;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use jojoe77777\FormAPI\SimpleForm;
use Mail\Mail;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MyMailsUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$mails_data = yield from $this->getLoader()->getProvider()->selectTo($this->getUsername());
			if(empty($mails_data)){
				$player->sendMessage(Lang::translate($player, TF::mail_nothaverecieved()));
				return;
			}
			$form = new SimpleForm(function(Player $player, ?int $data) use ($mails_data){
				if(!isset($data)) return;
				$mail = Mail::fromArray($mails_data[$data]);
				new MailInfo($this->getLoader(), $player, $this->getUsername(), $mail->getId(), MailInfo::TO);
			});
			foreach($mails_data as $mail_data){
				$mail = Mail::fromArray($mail_data);
				if($mail->isRead()){
					$form->addButton(Lang::translate($player, TF::mail_ui_mymails_button($mail->getTitle(), $mail->getFrom())));
				}else{
					$form->addButton(Lang::translate($player, TF::mail_ui_mymails_button_new($mail->getTitle(), $mail->getFrom())));
				}
			}
			$form->setTitle(Lang::translate($player, TF::mail_ui_mymails_title()));
			$player->sendForm($form);
		});
	}
}