<?php
declare(strict_types=1);

namespace Bazaar\command;

use Bazaar\Bazaar;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
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
		// TODO: Implement execute() method.
	}

	public function getOwningPlugin() : Plugin{
		return $this->getBazaar();
	}
}