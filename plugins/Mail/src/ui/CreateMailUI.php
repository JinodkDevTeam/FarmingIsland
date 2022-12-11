<?php
declare(strict_types=1);

namespace Mail\ui;

use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\CustomForm;
use Mail\Loader;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\Server;
use SOFe\AwaitGenerator\Await;

class CreateMailUI extends BaseUI{

	protected string $to = "";

	public function __construct(Loader $loader, Player $player, string $username = "", string $to = ""){
		$this->to = $to;
		parent::__construct($loader, $player, $username);
	}

	public function execute(Player $player) : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			if(!isset($data)) return;
			if(!isset($data[0])) return;
			if(!isset($data[1])) return;
			if(!isset($data[2])) return;
			if(!isset($data[3])) return;
			$to = $data[0];
			$title = $data[1];
			$message = $data[2];
			$attach = (bool) $data[3];
			if($attach){
				$this->AttachItems($player, $to, $title, $message);
			}else{
				Await::f2c(function() use ($player, $to, $title, $message){
					yield $this->getLoader()->getProvider()->sendMail($this->getUsername(), $to, $title, $message);
					$player->sendMessage(Lang::translate($player, TF::mail_create_success()));
					$notice = Server::getInstance()->getPlayerExact($to);
					if (!is_null($notice)){
						$notice->sendToastNotification(Lang::translate($notice, TF::mail_toast_title()), Lang::translate($notice, TF::mail_toast_new($this->getUsername())));
					}
				});
			}
		});
		$form->setTitle(Lang::translate($player, TF::mail_ui_create_title()));
		$form->addInput(Lang::translate($player, TF::mail_ui_create_input_to()), "Steve123", $this->to);
		$form->addInput(Lang::translate($player, TF::mail_ui_create_input_title_title()), Lang::translate($player, TF::mail_ui_create_input_title_placeholder()));
		$form->addInput(Lang::translate($player, TF::mail_ui_create_input_message_title()), Lang::translate($player, TF::mail_ui_create_input_message_placeholder()));
		$form->addToggle(Lang::translate($player, TF::mail_ui_create_toggle_attachitems()), false);

		$player->sendForm($form);
	}

	public function AttachItems(Player $player, string $to, string $title, string $message) : void{
		$menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
		$menu->setName(Lang::translate($player, TF::mail_gui_attachitems_name()));
		$menu->setInventoryCloseListener(function(Player $player, Inventory $inventory) use ($to, $title, $message){
			$items = [];
			foreach($inventory->getContents() as $item){
				$items[] = $item;
			}
			$data = ItemUtils::ItemArray2string($items);
			Await::f2c(function() use ($player, $to, $title, $message, $data){
				yield $this->getLoader()->getProvider()->sendMail($this->getUsername(), $to, $title, $message, $data);
				$player->sendMessage(Lang::translate($player, TF::mail_create_success()));
				$notice = Server::getInstance()->getPlayerExact($to);
				if (!is_null($notice)){
					$notice->sendToastNotification(Lang::translate($notice, TF::mail_toast_title()), Lang::translate($notice, TF::mail_toast_new($this->getUsername())));
				}
			});

		});
		$menu->send($player);
	}


}