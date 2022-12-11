<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class OpenForm extends BaseForm{

	protected function execute() : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if (!isset($data)) return;
			switch($data){
				case 0:
					$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
					if ($plot == null){
						$player->sendMessage(FILang::translate($player, TranslationFactory::favis_notinisland()));
						return;
					}
					Await::f2c(function() use ($player, $plot){
						yield $this->getLoader()->getProvider()->register($player, $plot->X, $plot->Z);
						$player->sendMessage(FILang::translate($player, TranslationFactory::favis_addisland_success()));
					});
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
		$form->setTitle(FILang::translate($this->player, TranslationFactory::favis_ui_main_title()));
		$form->addButton(FILang::translate($this->player, TranslationFactory::favis_ui_main_button_addcurrent()));
		$form->addButton(FILang::translate($this->player, TranslationFactory::favis_ui_main_button_addid()));
		$form->addButton(FILang::translate($this->player, TranslationFactory::favis_ui_main_button_teleport()));
		$form->addButton(FILang::translate($this->player, TranslationFactory::favis_ui_main_button_remove()));

		$this->getPlayer()->sendForm($form);
	}
}