<?php
declare(strict_types=1);

namespace AuctionHouse\command;

use AuctionHouse\Loader;
use AuctionHouse\menu\ui\OpenUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class AuctionHouseCommand extends Command implements PluginOwned{
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
		parent::__construct("ah", "Open Auction House", null, ["auctionhouse", "auction"]);
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if (!$sender instanceof Player){
			$sender->sendMessage("Please use this feature in-game !");
			return;
		}
		new OpenUI($this->getLoader(), $sender);
	}

	public function getOwningPlugin() : Plugin{
		return $this->getLoader();
	}
}
