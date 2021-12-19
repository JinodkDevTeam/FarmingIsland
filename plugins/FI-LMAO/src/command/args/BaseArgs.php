<?php
declare(strict_types=1);

namespace LMAO\command\args;

use pocketmine\command\CommandSender;

abstract class BaseArgs{

	public function __construct(CommandSender $sender, array $args){
		unset($args[0]);
		$args = array_values($args);
		$this->handle($sender, $args);
	}

	public function handle(CommandSender $sender, array $args) : void{
	}
}