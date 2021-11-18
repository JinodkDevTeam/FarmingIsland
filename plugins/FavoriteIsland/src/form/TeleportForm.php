<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use Generator;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;

class TeleportForm extends AwaitListForm{

	protected function g2c() : Generator{
		$data = yield $this->getLoader()->getProvider()->selectPlayer($this->getPlayer());

		$form = new SimpleForm(function(Player $player, ?int $value) use ($data){
			if(!isset($value)) return;
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Core::getInstance()->getIslandWorldName(), $data[$value]["X"], $data[$value]["Z"]);
			MyPlot::getInstance()->teleportPlayerToPlot($player, $plot);
		});
		$form->setTitle("Teleport to favorite island !");
		foreach($data as $island){
			$plot = MyPlot::getInstance()->getProvider()->getPlot(Core::getInstance()->getIslandWorldName(), $island["X"], $island["Z"]);
			$form->addButton($plot->name . "(" . $plot->X . ";" . $plot->Z . ")" . "\n" . $plot->owner);
		}
		$this->getPlayer()->sendForm($form);
	}
}