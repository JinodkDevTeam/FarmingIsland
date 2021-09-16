<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use FavoriteIslands\Loader;
use Generator;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;

class TeleportForm extends AwaitListForm{

	protected function g2c() : Generator{
		$data = yield $this->getLoader()->getProvider()->selectPlayer($this->getPlayer());

		$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
			if(!isset($value)) return;
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Loader::WORLD_NAME, $data[$value]["X"], $data[$value]["Z"]);
			MyPlot::getInstance()->teleportPlayerToPlot($player, $plot);
		});
		$form->setTitle("Teleport to favorite island !");
		foreach($data as $island){
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Loader::WORLD_NAME, $island["X"], $island["Z"]);
			$form->addButton($plot->name . "(" . $plot->X . ";" . $plot->Z . ")" . "\n" . $plot->owner);
		}
		$this->getPlayer()->sendForm($form);
	}
}