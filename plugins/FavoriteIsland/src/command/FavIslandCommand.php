<?php
declare(strict_types=1);

namespace FavoriteIslands\command;

use FavoriteIslands\form\OpenForm;
use FavoriteIslands\Loader;
use FILang\FILang;
use FILang\TranslationFactory;
use MyPlot\MyPlot;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
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
		if ($sender instanceof Player){
			if (!MyPlot::getInstance()->isLevelLoaded($sender->getWorld()->getDisplayName())){
				$sender->sendMessage(FILang::translate($sender, TranslationFactory::favis_command_notislandworld()));
				return;
			}
			new OpenForm($this->getLoader(), $sender);
		}else{
			$sender->sendMessage(FILang::translate($sender, TranslationFactory::command_ingame()));
		}
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}
}