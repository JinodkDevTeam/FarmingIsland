<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FavoriteIslands\Loader;
use jojoe77777\FormAPI\CustomForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;

class AddByIdForm extends BaseForm{

	protected function execute() : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			if (!isset($data[0])) return;
			$ids = explode(";", $data[0]);
			if (isset($ids[0]) and isset($ids[1])){
				if (is_numeric($ids[0]) and is_numeric($ids[1])){
					$plot = MyPlot::getInstance()->getProvider()->getPlot(Loader::WORLD_NAME, (int)$ids[0], (int)$ids[1]);
					if ($plot->owner == ""){
						$player->sendMessage("You cannot add un-claimed plot !");
						return;
					}
					$this->getLoader()->addFavorite($player, (int)$ids[0], (int)$ids[1]);
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

		$this->getPlayer()->sendForm($form);
	}
}