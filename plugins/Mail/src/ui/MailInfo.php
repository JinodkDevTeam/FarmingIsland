<?php
declare(strict_types=1);

namespace Mail\ui;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use Mail\Loader;
use Mail\Mail;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MailInfo extends BaseUI{

	public const FROM = 0;
	public const TO = 1;

	protected int $mode = 1;
	protected int $mail_id = 0;

	public function __construct(Loader $loader, Player $player, string $username = "", int $mail_id = 0, int $mode = 1){
		$this->mode = $mode;
		$this->mail_id = $mail_id;
		parent::__construct($loader, $player, $username);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$select = yield from $this->getLoader()->getProvider()->selectId($this->mail_id);
			if(empty($select)) return;
			$mail = Mail::fromArray($select[0]);
			if($this->mode == self::TO){
				$this->getLoader()->getProvider()->updateIsRead($mail->getId(), true);
			}
			$items = ItemUtils::string2ItemArray($mail->getItems());
			$form = new SimpleForm(function(Player $player, ?int $data) use ($mail){
				if(!isset($data)) return;
				switch($data){
					case 0:
						$this->delete($player, $mail);
						break;
					case 1:
						new CreateMailUI($this->getLoader(), $player, $this->getUsername(), $mail->getFrom());
						break;
					case 2:
						$this->claimItems($player, $mail);
						break;
				}
			});
			$form->setTitle(Lang::translate($player, TF::mail_ui_info_title()));
			$content = [
				Lang::translate($player, TF::mail_ui_info_content_id((string)$mail->getId())),
				Lang::translate($player, TF::mail_ui_info_content_from($mail->getFrom())),
				Lang::translate($player, TF::mail_ui_info_content_to($mail->getTo())),
				Lang::translate($player, TF::mail_ui_info_content_title($mail->getTitle())),
				Lang::translate($player, TF::mail_ui_info_content_message()),
				$mail->getMsg(),
				Lang::translate($player, TF::mail_ui_info_content_attachments()),
			];
			if($items == []){
				$content[] = Lang::translate($player, TF::mail_ui_info_content_noneattachment());
			}else{
				foreach($items as $item){
					if($item->hasCustomName()) $name = $item->getCustomName();else $name = $item->getName();
					$content[] = "x" . $item->getCount() . " " . $name;
				}
			}
			$form->setContent(implode("\n", $content));
			$form->addButton(Lang::translate($player, TF::mail_ui_info_button_delete()));
			if ($this->mode == self::TO){
				$form->addButton(Lang::translate($player, TF::mail_ui_info_button_reply()));
				if (!$mail->isClaimed()){
					$form->addButton(Lang::translate($player, TF::mail_ui_info_button_claim()));
				}
			}

			$player->sendForm($form);
		});
	}

	public function claimItems(Player $player, Mail $mail) : void{
		if($this->mode == self::FROM){
			$player->sendMessage(Lang::translate($player, TF::mail_claim_fail_notreceiver()));
			return;
		}
		if($mail->isClaimed()){
			$player->sendMessage(Lang::translate($player, TF::mail_claim_fail_already()));
			return;
		}
		$items = ItemUtils::string2ItemArray($mail->getItems());
		$empty = $player->getInventory()->getSize() - count($player->getInventory()->getContents());
		if($empty > count($items)){
			foreach($items as $item){
				$player->getInventory()->addItem($item);
			}
			$this->getLoader()->getProvider()->updateIsClaimed($mail->getId(), true);
		}else{
			$player->sendMessage(Lang::translate($player, TF::mail_claim_fail_notenoughspace()));
		}
	}

	public function delete(Player $player, Mail $mail){
		$message = Lang::translate($player, TF::mail_ui_delete_content_claimed());
		if (($this->mode == self::TO) and (!$mail->isClaimed())){
			$message = Lang::translate($player, TF::mail_ui_delete_content_unclaimed());
		}
		$form = new ModalForm(function(Player $player, ?bool $data) use ($mail){
			if(!isset($data)) return;
			if(!$data) return;
			if ($this->mode == self::FROM){
				if ($mail->isDeletedByTo()){
					Await::f2c(function() use ($mail){
						yield $this->getLoader()->getProvider()->remove($mail->getId());
					});
				} else {
					$this->getLoader()->getProvider()->updateIsDeletedByFrom($mail->getId(), true);
				}
			}
			if ($this->mode == self::TO){
				if ($mail->isDeletedByFrom()){
					Await::f2c(function() use ($mail){
						yield $this->getLoader()->getProvider()->remove($mail->getId());
					});
				} else {
					$this->getLoader()->getProvider()->updateIsDeletedByTo($mail->getId(), true);
				}
			}
		});

		$form->setTitle(Lang::translate($player, TF::mail_ui_delete_title()));
		$form->setContent($message);
		$form->setButton1(Lang::translate($player, TF::mail_ui_delete_button_yes()));
		$form->setButton2(Lang::translate($player, TF::mail_ui_delete_button_no()));
		$player->sendForm($form);
	}
}
