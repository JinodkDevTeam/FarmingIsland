<?php
declare(strict_types=1);

namespace FavoriteIslands\command;

use FavoriteIslands\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class FavIslandCommand extends Command implements PluginOwned{
	use PluginOwnedTrait;

	protected Loader $loader;

	public function __construct(Loader $loader, string $name, string $description = "", ?string $usageMessage = null, array $aliases = []){
		$this->loader = $loader;
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("favoriteisland.command");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : void{

	}

	protected function getLoader() : Loader{
		return $this->loader;
	}
}