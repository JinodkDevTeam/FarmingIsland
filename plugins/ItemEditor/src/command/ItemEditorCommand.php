<?php
declare(strict_types=1);

namespace ItemEditor\command;

use ItemEditor\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class ItemEditorCommand extends Command implements PluginOwned{

	private Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
		parent::__construct(
			"itemeditor",
			"Edit item in your hand",
			null,
			["iedit", "ie"]
		);
		$this->setPermission("iedit.command");
	}

	private function getLoader() : Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender->hasPermission("iedit.command")){
			$sender->sendMessage("You dont have permission to use this feature");
			return;
		}
		if (!$sender instanceof Player){
			$sender->sendMessage("Please use this feature in-game.");
		}
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}

}