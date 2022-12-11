<?php
declare(strict_types=1);

namespace Backpack\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BackpackManagerUI extends BaseUI{

	protected function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->getLoader()->getProvider()->selectPlayer($player);
			if (empty($data)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::backpack_nothave()));
				return;
			}
			$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
				if (!isset($value)) return;
				if (isset($data[$value])){
					new BackpackOpenGUI($this->getLoader(), $player, $data[$value]["Slot"]);
				} else {
					$player->sendMessage(FILang::translate($player, TranslationFactory::backpack_openfail()));
				}
			});
			foreach($data as $backpack){
				$form->addButton(FILang::translate($player, TranslationFactory::backpack_ui_button((string)$backpack["Slot"])));
			}
			$form->setTitle(FILang::translate($player, TranslationFactory::backpack_ui_title()));
			$player->sendForm($form);
		});
	}
}