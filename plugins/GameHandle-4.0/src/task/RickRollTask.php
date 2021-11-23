<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\task;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class RickRollTask extends Task{

	protected Player $player;

	protected int $line = 0;

	/** @var string[] */
	protected array $lyric = [
		"We're no strangers to love", //0
		"You know the rules and so do I !", //1
		"A full commitment's what I'm thinking of", //2
		"You wouldn't get this from any other guy...", //3
		"I just wanna tell you how I'm feeling...", //4
		"Gotta make you understand !", //5
		"Never gonna give you up", //6
		"Never gonna let you down", //7
	];

	public function __construct(Player $player){
		$this->player = $player;
	}

	public function onRun() : void{
		if ($this->line > 7){
			$this->player->kick("Never gonna run around and desert you");
			$this->getHandler()->cancel();
			return;
		}
		$this->player->sendMessage($this->lyric[$this->line]);
		$this->line++;
	}
}