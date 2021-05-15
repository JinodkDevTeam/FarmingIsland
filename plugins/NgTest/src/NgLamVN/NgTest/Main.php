<?php

declare(strict_types=1);

namespace NgLamVN\NgTest;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 * @ignoreCancelled true
	 */
	public function onBreak(BlockBreakEvent $event)
	{
		$block = $event->getBlock();
		$player = $event->getPlayer();

		$player->sendMessage("You have break block: " . $block->getName());
	}
}
