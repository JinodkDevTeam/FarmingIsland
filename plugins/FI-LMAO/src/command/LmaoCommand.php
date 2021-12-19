<?php
declare(strict_types=1);

namespace LMAO\command;

use LMAO\command\args\HelpArgs;
use LMAO\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class LmaoCommand extends Command implements PluginOwned{

	protected Loader $loader;

	public function __construct(Loader $loader){
		parent::__construct("lmao", "", null, []);
		$this->loader = $loader;
		$this->setDescription("LOLOLOLOLOLOLOLOLOLOLOL");
		$this->setPermission("lmao.cmd");
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender->hasPermission("lmao.cmd")){
			$sender->sendMessage("Do you think you can use this command??? LOL you can't !");
			return;
		}
		if (!isset($args[0])){
			$sender->sendMessage("Unknow args, please use /lmao help");
			return;
		}
		switch($args[0]){
			case "help":
				new HelpArgs($sender, $args);
				break;

			default:
				$sender->sendMessage("Unknow args, please use /lmao help");
		}
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}
}