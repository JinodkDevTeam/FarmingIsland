<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class ServerCheck extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "servercheck");
		$this->setDescription("Check server");
		$this->setPermission("gh.servercheck");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender->hasPermission("gh.servercheck")){
			$sender->sendMessage("You dont have permission to use this command !");
			return;
		}
		if(isset($args[0])){
			switch($args[0]){
				case "php-extensions":
					$sender->sendMessage("PHP Loaded Extensions:");
					foreach(get_loaded_extensions() as $extension){
						$sender->sendMessage($extension . " v" . phpversion($extension));
					}
					break;
				case "scan-extensions":
					$sender->sendMessage("PHP Extensions Scanning ...");

					if(!extension_loaded("gd")){
						$sender->sendMessage("Missed gd extension !");
					}
					if(!extension_loaded("crypto")){
						$sender->sendMessage("Missed crypto extension !");
					}
					if(!extension_loaded("igbinary")){
						$sender->sendMessage("Missed igbinary extension !");
					}
					if(!extension_loaded("leveldb")){
						$sender->sendMessage("Missed leveldb extension !");
					}
					if(!extension_loaded("mysqli")){
						$sender->sendMessage("Missed mysqli extension !");
					}
					if(!extension_loaded("openssl")){
						$sender->sendMessage("Missed openssl extension !");
					}
					if(!extension_loaded("chunkutils2")){
						$sender->sendMessage("Missed chunkutils2 extension !");
					}
					if(!extension_loaded("pthreads")){
						$sender->sendMessage("Missed pthreads extension !");
					}
					if(!extension_loaded("recursionguard")){
						$sender->sendMessage("Missed recursionguard extension !");
					}
					if(!extension_loaded("sqlite3")){
						$sender->sendMessage("Missed sqlite3 extension !");
					}
					$sender->sendMessage("Extension scan done !");
					break;
			}
			return;
		}
		$sender->sendMessage("Checking server ...");
		$sender->sendMessage("Software Ver: " . Server::getInstance()->getPocketMineVersion());
		$sender->sendMessage("PHP Version: " . PHP_VERSION);
		$sender->sendMessage("OS: " . PHP_OS);
	}
}

