<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use CortexPE\Commando\BaseCommand as CommandoBaseCommand;

abstract class BaseCommand extends CommandoBaseCommand{

	protected Core $core;

	public function __construct(Core $core, string $name, string $description = "", array $aliases = []){
		$this->core = $core;
		parent::__construct($core, $name, $description, $aliases);
	}

	public function getCore() : Core{
		return $this->core;
	}

	protected abstract function prepare() : void;

	public abstract function onRun(CommandSender $sender, string $aliasUsed, array $args) : void;
}