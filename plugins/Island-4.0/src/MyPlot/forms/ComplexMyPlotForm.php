<?php
declare(strict_types=1);

namespace MyPlot\forms;

use Closure;
use dktapps\pmforms\CustomForm;
use MyPlot\MyPlot;
use MyPlot\Plot;
use pocketmine\player\Player;

abstract class ComplexMyPlotForm extends CustomForm implements MyPlotForm{
	/** @var Plot|null $plot */
	protected ?Plot $plot;

	public function __construct(string $title, array $elements, Closure $onSubmit){
		parent::__construct($title, $elements, $onSubmit,
			function(Player $player) : void{
				$player->getServer()->dispatchCommand($player, MyPlot::getInstance()->getLanguage()->get("command.name"), true);
			}
		);
	}

	public function getPlot() : ?Plot{
		return $this->plot;
	}

	public function setPlot(?Plot $plot) : void{
		$this->plot = $plot;
	}
}