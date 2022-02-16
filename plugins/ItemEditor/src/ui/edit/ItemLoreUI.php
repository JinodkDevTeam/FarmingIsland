<?php
declare(strict_types=1);

namespace ItemEditor\ui\edit;

use ItemEditor\ui\BaseUI;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class ItemLoreUI extends BaseUI{

	protected int $line;

	public function __construct(Player $player, int $line){
		$this->line = $line;
		parent::__construct($player);
	}

	protected function execute(Player $player){
		$item = $player->getInventory()->getItemInHand();
		$lore = $item->getLore();
		$form = new CustomForm(function(Player $player, ?array $data){
			//TODO: Handle Output
		});
		$form->setTitle("Edit Item Lore");
		$form->addInput("Lore:", "abcd1234", $lore[$this->line]);
		$player->sendForm($form);
	}
}