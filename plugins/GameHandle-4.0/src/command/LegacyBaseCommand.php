<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;

/**
 * This is the legacy BaseCommand class use for old command design
 */
abstract class LegacyBaseCommand extends Command implements PluginOwned{
	private Core $core;

	public function __construct(Core $core, string $name, string $description = "", ?string $usageMessage = null, array $aliases = []){
		$this->core = $core;
		parent::__construct($name, $description, $usageMessage, $aliases);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		//NOTHING.
	}

	public function getOwningPlugin() : Core{
		return $this->core;
	}

	protected function getCore() : Core{
		return $this->core;
	}
}