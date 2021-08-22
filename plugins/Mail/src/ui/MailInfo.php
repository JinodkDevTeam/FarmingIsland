<?php
declare(strict_types=1);

namespace Mail\ui;

use JinodkDevTeam\utils\ItemUtils;
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
			if (empty($select)) return;
			$mail = Mail::fromArray($select[0]);
			if ($this->mode == self::TO){
				$this->getLoader()->getProvider()->updateIsRead($mail->getId(), true);
			}
			$items = ItemUtils::MailItemsDecode($mail->getItems());
			$form = new SimpleForm(function(Player $player, ?int $data) use ($mail){
				if (!isset($data)) return;
				if ($data == 0) $this->claimItems($player, $mail);
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
			if ($items == []){
				array_push($content, "- None");
			} else {
				foreach($items as $item){
					if ($item->hasCustomName()) $name = $item->getCustomName(); else $name = $item->getName();
					array_push($content, "x" . $item->getCount() . " " . $name);
				}
			}
			$form->setContent(implode("\n", $content));
			$form->addButton("Claim items");

			$player->sendForm($form);
		});
	}

	public function claimItems(Player $player, Mail $mail): void{
		if ($this->mode == self::FROM){
			$player->sendMessage("You can't claim items from this mail because you have sended it to another player !");
			return;
		}
		if ($mail->isClaimed()){
			$player->sendMessage("You already claim items from this mail !");
			return;
		}
		$items = ItemUtils::MailItemsDecode($mail->getItems());
		$empty = $player->getInventory()->getSize() - count($player->getInventory()->getContents());
		if ($empty > count($items)){
			foreach($items as $item){
				$player->getInventory()->addItem($item);
			}
			$this->getLoader()->getProvider()->updateIsClaimed($mail->getId(), true);
		} else {
			$player->sendMessage("Your inventory dont have enough space to claim items, make sure you have enough space and try again !");
		}
	}
}
