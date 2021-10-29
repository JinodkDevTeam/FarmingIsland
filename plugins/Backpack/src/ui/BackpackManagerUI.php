<?php
declare(strict_types=1);

namespace Backpack\ui;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BackpackManagerUI extends BaseUI{

	protected function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield $this->getLoader()->getProvider()->selectPlayer($player);
			if (empty($data)){
				$player->sendMessage("You dont have any backpack slot.");
				return;
			}
			$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
				if (!isset($value)) return;
				if (isset($data[$value])){
					new BackpackOpenGUI($this->getLoader(), $player, $data[$value]["Slot"]);
				} else {
					$player->sendMessage("Failed to open your backpack. Please report this error to admin.");
				}
			});
			foreach($data as $backpack){
				$form->addButton("Backpack slot " . $backpack["Slot"]);
			}
			$form->setTitle("Backpack manager");
			$player->sendForm($form);
		});
	}
}