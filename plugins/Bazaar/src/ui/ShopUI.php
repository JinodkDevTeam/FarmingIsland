<?php
declare(strict_types=1);

namespace Bazaar\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class ShopUI extends BaseUI{

	public function execute(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if(!isset($data)) return;
			if($data == 0){
				new MyOrderUI($player);
				return;
			}
			if ($data == 1){
				new CategoryMenu($player);
			}
		});
		$form->addButton(FILang::translate($player, TranslationFactory::bazaar_ui_main_button_myorders()));
		$form->addButton(FILang::translate($player, TranslationFactory::bazaar_ui_main_button_shop()));
		$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_main_title()));
		$player->sendForm($form);
	}
}