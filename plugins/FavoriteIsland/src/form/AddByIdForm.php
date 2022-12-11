<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\CustomForm;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class AddByIdForm extends BaseForm{

	protected function execute() : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			if (!isset($data[0])) return;
			$ids = explode(";", $data[0]);
			if (isset($ids[0]) and isset($ids[1])){
				if (is_numeric($ids[0]) and is_numeric($ids[1])){
					$plot = MyPlot::getInstance()->getProvider()->getPlot(Core::getInstance()->getIslandWorldName(), (int)$ids[0], (int)$ids[1]);
					if ($plot->owner == ""){
						$player->sendMessage(FILang::translate($player, TranslationFactory::favis_addid_fail_unclaimed()));
						return;
					}
					Await::f2c(function() use ($player, $ids, $data){
						yield $this->getLoader()->getProvider()->register($player, (int)$ids[0], (int)$ids[1]);
						$player->sendMessage(FILang::translate($player, TranslationFactory::favis_addid_success((string)$data[0])));
					});
				}else{
					$player->sendMessage(FILang::translate($player, TranslationFactory::favis_addid_fail_invalidid()));
				}
			}else{
				$player->sendMessage(FILang::translate($player, TranslationFactory::favis_addid_fail_invalidformat()));
			}
		});

		$form->setTitle(FILang::translate($this->player, TranslationFactory::favis_ui_addid_title()));
		$form->addInput(FILang::translate($this->player, TranslationFactory::favis_ui_addid_input()), "x;z", "0;0");

		$this->getPlayer()->sendForm($form);
	}
}