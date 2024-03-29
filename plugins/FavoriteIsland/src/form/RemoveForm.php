<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FILang\FILang;
use FILang\TranslationFactory;
use Generator;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;

class RemoveForm extends AwaitListForm{

	protected function g2c() : Generator{
		$data = yield from $this->getLoader()->getProvider()->selectPlayer($this->getPlayer());

		$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
			if(!isset($value)) return;
			yield $this->getLoader()->getProvider()->remove($player, $data[$value]["X"], $data[$value]["Z"]);
		});
		$form->setTitle(FILang::translate($this->getPlayer(), TranslationFactory::favis_ui_remove_title()));
		foreach($data as $island){
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Core::getInstance()->getIslandWorldName(), $island["X"], $island["Z"]);
			$form->addButton($plot->name . "(" . $plot->X . ";" . $plot->Z . ")" . "\n" . $plot->owner);
		}
		$this->getPlayer()->sendForm($form);
	}
}