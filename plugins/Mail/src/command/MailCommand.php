<?php
declare(strict_types=1);

namespace Mail\command;

use Mail\Loader;
use Mail\ui\MailUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class MailCommand extends Command implements PluginOwned{

	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader =$loader;
		parent::__construct("mail", "Mail system", null, []);
	}

	public function getLoader(): Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if ($sender instanceof Player){
			new MailUI($this->getLoader(), $sender);
			return;
		}
		$sender->sendMessage("Please use this command as a player !");
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}
}