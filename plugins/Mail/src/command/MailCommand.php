<?php
declare(strict_types=1);

namespace Mail\command;

use Mail\Loader;
use Mail\ui\CreateMailUI;
use Mail\ui\MailUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class MailCommand extends Command implements PluginOwned{

	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
		parent::__construct("mail", "Mail system", null, []);
		$this->setPermission("mail.command");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : void{
		if($sender instanceof Player){
			if (isset($args[0])) {
				if($args[0] == "login"){
					if(!isset($args[1])){
						$sender->sendMessage("§cUsage: /mail login <username>");
						return;
					}
					if(!$sender->hasPermission("mail.login")){
						$sender->sendMessage("You don't have permission to use this feature");
						return;
					}
					new MailUI($this->getLoader(), $sender, $args[1]);
					return;
				}
				new CreateMailUI($this->getLoader(), $sender, $sender->getName(), $args[0]);
				return;
			}
			new MailUI($this->getLoader(), $sender, $sender->getName());
		}
		$sender->sendMessage("Please use this command as a player !");
	}

	public function getLoader() : Loader{
		return $this->loader;
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}
}