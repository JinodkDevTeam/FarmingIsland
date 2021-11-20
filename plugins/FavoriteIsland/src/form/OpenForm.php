<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;

class OpenForm extends BaseForm{

	protected function execute() : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if (!isset($data)) return;
			switch($data){
				case 0:
					$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
					if ($plot == null){
						$player->sendMessage("You are not in a island !");
						return;
					}
					$this->getLoader()->addFavorite($player, $plot->X, $plot->Z);
					$player->sendMessage("Added island to favorite !");
					break;
				case 1:
					new AddByIdForm($this->getLoader(), $player);
					break;
				case 2:
					new TeleportForm($this->getLoader(), $player);
					break;
				case 3:
					new RemoveForm($this->getLoader(), $player);
			}
		});
		$form->setTitle("Favorite Islands Manager");
		$form->addButton("Add current standing island");
		$form->addButton("Add island by id");
		$form->addButton("Teleport to favorite islands");
		$form->addButton("Remove Favorite island");

		$this->getPlayer()->sendForm($form);
	}
}