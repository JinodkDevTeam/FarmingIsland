<?php
declare(strict_types=1);

namespace ItemEditor\ui\list;

use ItemEditor\ui\BaseUI;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class ItemLoreList extends BaseUI{

	protected function execute(Player $player){
		$item = $player->getInventory()->getItemInHand();
		$lore = $item->getLore();
		$form = new SimpleForm(function(Player $player, ?int $data) use ($lore){

		});
		$form->setTitle("Edit item lore");
		foreach($lore as $line){
			$form->addButton($line);
		}
		$form->setContent("Click to edit or remove");
		$form->addButton("Add Line");
		$form->addButton("Remove all");
	}
}