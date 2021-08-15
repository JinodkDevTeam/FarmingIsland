<?php
declare(strict_types=1);

namespace Bazaar\command;

use Bazaar\Bazaar;
use Bazaar\ui\ShopUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class BazaarCommand extends Command implements PluginOwned
{
	private Bazaar $bazaar;

	public function __construct(Bazaar $bazaar){
		$this->bazaar = $bazaar;
		parent::__construct("bazaar", "", null, []);
	}

	public function getBazaar(): Bazaar{
		return $this->bazaar;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender instanceof Player){
			$sender->sendMessage("Please use this command as Player");
			return;
		}
		new ShopUI($sender);
	}

	public function getOwningPlugin() : Plugin{
		return $this->getBazaar();
	}
}