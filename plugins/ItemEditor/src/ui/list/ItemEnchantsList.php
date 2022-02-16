<?php
declare(strict_types=1);

namespace ItemEditor\ui\list;

use ItemEditor\ui\BaseUI;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class ItemEnchantsList extends BaseUI{
	protected function execute(Player $player){
		$item = $player->getInventory()->getItemInHand();
		$enchants = $item->getEnchantments();
		$form = new SimpleForm(function(Player $player, ?int $data){
			//TODO: handle output
		});
		$form->setContent("Click to remove enchant");
		$form->setTitle("Item Enchants");
		foreach($enchants as $enchant){
			$form->addButton($enchant->getType()->getName() . " " . $enchant->getLevel());
		}
		$form->addButton("Add Enchants");
		$form->addButton("Remove all enchants");

		$player->sendForm($form);
	}
}