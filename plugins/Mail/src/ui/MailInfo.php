<?php
declare(strict_types=1);

namespace Mail\ui;

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

	public function __construct(Loader $loader, Player $player, int $mail_id = 0, int $mode = 1){
		$this->mode = $mode;
		$this->mail_id = $mail_id;
		parent::__construct($loader, $player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$select = yield $this->getLoader()->getProvider()->selectId($this->mail_id);
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
						new CreateMailUI($this->getLoader(), $player, $mail->getFrom());
						break;
					case 2:
						$this->claimItems($player, $mail);
						break;
				}
			});
			$form->setTitle("Mail Info");
			$content = [
				"Mail ID: " . $mail->getId(),
				"From: " . $mail->getFrom(),
				"To: " . $mail->getTo(),
				"Title: " . $mail->getTitle(),
				"Message:",
				$mail->getMsg(),
				"Attachment:"
			];
			if($items == []){
				array_push($content, "- None");
			}else{
				foreach($items as $item){
					if($item->hasCustomName()) $name = $item->getCustomName();else $name = $item->getName();
					array_push($content, "x" . $item->getCount() . " " . $name);
				}
			}
			$form->setContent(implode("\n", $content));
			$form->addButton("Delete");
			if ($this->mode = self::TO){
				$form->addButton("Reply");
				if (!$mail->isClaimed()){
					$form->addButton("Claim items");
				}
			}

			$player->sendForm($form);
		});
	}

	public function claimItems(Player $player, Mail $mail) : void{
		if($this->mode == self::FROM){
			$player->sendMessage("You can't claim items from this mail because you have sended it to another player !");
			return;
		}
		if($mail->isClaimed()){
			$player->sendMessage("You already claim items from this mail !");
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
			$player->sendMessage("Your inventory dont have enough space to claim items, make sure you have enough space and try again !");
		}
	}

	public function delete(Player $player, Mail $mail){
		$message = "Are you sure about delete this mail, this action can't be undone !";
		if (($this->mode == self::TO) and (!$mail->isClaimed())){
			$message = "Are you sure about delete this mail without claiming items, this action can't be undone !";
		}
		$form = new ModalForm(function(Player $player, ?bool $data) use ($mail){
			if(!isset($data)) return;
			if($data == false) return;
			if ($this->mode == self::FROM){
				if ($mail->isDeletedByTo()){
					$this->getLoader()->getProvider()->remove($mail->getId());
				} else {
					$this->getLoader()->getProvider()->updateIsDeletedByFrom($mail->getId(), true);
				}
			}
			if ($this->mode == self::TO){
				if ($mail->isDeletedByFrom()){
					$this->getLoader()->getProvider()->remove($mail->getId());
				} else {
					$this->getLoader()->getProvider()->updateIsDeletedByTo($mail->getId(), true);
				}
			}
		});

		$form->setTitle("Confirm");
		$form->setContent($message);
		$form->setButton1("YES");
		$form->setButton2("NO");
		$player->sendForm($form);
	}
}
