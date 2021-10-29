<?php
declare(strict_types=1);

namespace Backpack\command;

use Backpack\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class BackpackCommand extends Command implements PluginOwned{

	protected Loader $loader;

	public function __construct(Loader $loader, string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = []){
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->loader = $loader;
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		// TODO: Open Backpack.
	}

	public function getOwningPlugin() : Plugin{
		return $this->loader;
	}
}