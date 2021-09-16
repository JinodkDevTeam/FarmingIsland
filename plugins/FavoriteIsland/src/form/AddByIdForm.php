<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class AddByIdForm extends BaseForm{

	protected function execute() : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			if (!isset($data[0])) return;
			$ids = explode(";", $data[0]);
			if (isset($ids[0]) and isset($ids[1])){
				if (is_int($ids[0]) and is_int($ids[1])){
					$this->getLoader()->addFavorite($player, $ids[0], $ids[1]);
					$player->sendMessage("Added " . $data[0] . " to favorite list !");
				}else{
					$player->sendMessage("Wrong id number !");
				}
			}else{
				$player->sendMessage("Wrong id format.");
			}
		});

		$form->setTitle("Add by id");
		$form->addInput("ID: ", "x;z", "0;0");
	}
}