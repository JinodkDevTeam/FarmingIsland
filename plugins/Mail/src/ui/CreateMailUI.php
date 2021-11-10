<?php
declare(strict_types=1);

namespace Mail\ui;

use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\CustomForm;
use Mail\Mail;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\Server;

class CreateMailUI extends BaseUI{

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
				$this->createMail($player->getName(), $to, $title, $message);
				$player->sendMessage("Mail Created !");
			}
		});

		$form->setTitle("Create new mail");
		$form->addInput("To:", "Steve123");
		$form->addInput("Title:", "Hi ?");
		$form->addInput("Message:", "Type some thing ...");
		$form->addToggle("Attach items", false);

		$player->sendForm($form);
	}

	public function AttachItems(Player $player, string $to, string $title, string $message) : void{
		$menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
		$menu->setName("Attach Items");
		$menu->setInventoryCloseListener(function(Player $player, Inventory $inventory) use ($to, $title, $message){
			$items = [];
			foreach($inventory->getContents() as $item){
				array_push($items, $item);
			}
			$data = ItemUtils::ItemArray2string($items);
			$this->createMail($player->getName(), $to, $title, $message, $data);
			$player->sendMessage("Mail Created !");
			$notice = Server::getInstance()->getPlayerExact($to);
			$notice?->sendMessage("You have new mail form " . $player->getName());
		});
		$menu->send($player);
	}

	public function createMail(string $from, string $to, string $title, string $message, string $items = "") : void{
		$mail = new Mail(-1, $from, $to, $title, $message, $items);
		$this->getLoader()->getProvider()->register($mail);
	}
}