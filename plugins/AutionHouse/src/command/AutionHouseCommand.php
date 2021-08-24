<?php
declare(strict_types=1);

namespace AutionHouse\command;

use AutionHouse\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class AutionHouseCommand extends Command implements PluginOwned{
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
		parent::__construct("ah", "Open Aution House", null, ["autionhouse", "aution"]);
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		// TODO: Implement execute() method.
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}
}
