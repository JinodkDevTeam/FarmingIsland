<?php
declare(strict_types=1);

namespace IslandMaker;

use Exception;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class IsMakerCommand extends Command implements PluginOwned{
	use PluginOwnedTrait;

	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
		parent::__construct("ismaker", "", "", []);
		$this->setPermission("islandmaker.cmd");
	}

	protected function getLoader() : Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender instanceof Player){
			$sender->sendMessage("Please use this command as player !");
			return;
		}
		if (isset($args[0])){
			switch($args[0]){
				case "pos1":
					$this->getLoader()->setStatus($sender, Loader::POS1);
					$sender->sendMessage("Tap a block to set pos1.");
					break;
				case "pos2":
					$this->getLoader()->setStatus($sender, Loader::POS2);
					$sender->sendMessage("Tap a block to set pos2.");
					break;
				case "spawnpoint":
					$spawn_point = $sender->getPosition()->down();
					$this->getLoader()->spawn_point = $spawn_point;
					$sender->sendMessage("Set base spawn point at: " . $spawn_point->getX() . " " . $spawn_point->getY() . " " . $spawn_point->getZ() . " (will be recaculated when use generate !)");
					break;
				case "make":
					$sender->sendMessage("Getting blocks and make data in pos1 and pos2...");
					try{
						$this->getLoader()->make();
					} catch(Exception $e){
						$sender->sendMessage("An error has occour when making data.");
						$sender->sendMessage("Error: " . $e->getMessage());
						return;
					}
					$sender->sendMessage("Making data successful, use /islandmaker generate to write generator data to file.");
					break;
				case "generate":
					$sender->sendMessage("Generating structure code...");
					try{
						$this->getLoader()->generate();
					} catch(Exception $e){
						$sender->sendMessage("An error has occour when generating structure codes.");
						$sender->sendMessage("Error: " . $e->getMessage());
						return;
					}
					$sender->sendMessage("Generated structure code, check plugin data folder for result !");
					break;

			}
		}
	}
}