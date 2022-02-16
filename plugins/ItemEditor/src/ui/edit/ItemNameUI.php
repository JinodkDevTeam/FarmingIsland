<?php
declare(strict_types=1);

namespace ItemEditor\ui\edit;

use ItemEditor\ui\BaseUI;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class ItemNameUI extends BaseUI{

	protected function execute(Player $player){
		$form = new CustomForm(function(Player $player, ?array $data){

		});
		$item = $player->getInventory()->getItemInHand();
		$form->setTitle("Edit item name");
		$form->addInput("Item name:", "ABCD123", $item->getName());
		$player->sendForm($form);
	}
}