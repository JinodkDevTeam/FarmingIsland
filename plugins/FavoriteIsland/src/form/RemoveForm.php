<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FavoriteIslands\Loader;
use Generator;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;

class RemoveForm extends AwaitListForm{

	protected function g2c() : Generator{
		$data = yield $this->getLoader()->getProvider()->selectPlayer($this->getPlayer());

		$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
			if(!isset($value)) return;
			$this->getLoader()->getProvider()->remove($player, $data[$value]["X"], $data[$value]["Z"]);
		});
		$form->setTitle("Remove Favorite Island");
		foreach($data as $island){
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Loader::WORLD_NAME, $island["X"], $island["Z"]);
			$form->addButton($plot->name . "(" . $plot->X . ";" . $plot->Z . ")" . "\n" . $plot->owner);
		}
		$this->getPlayer()->sendForm($form);
	}
}