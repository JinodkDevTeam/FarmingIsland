<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\command\args;

use CortexPE\Commando\args\StringEnumArgument;
use NgLam2911\MineSweeper\area\texture\AreaTextures;
use pocketmine\command\CommandSender;

class AreaTextureArgs extends StringEnumArgument{

	public function __construct(bool $optional = false){
		parent::__construct("texture", $optional);
	}

	public function getEnumValues() : array{
		$textures = [];
		foreach(AreaTextures::getAll() as $texture){
			$textures[] = $texture->getName();
		}
		return $textures;
	}

	public function parse(string $argument, CommandSender $sender) : string{
		return $argument;
	}

	public function getTypeName() : string{
		return $this->name;
	}
}