<?php
declare(strict_types=1);

namespace LamPocketVN\PlayerAuto\features;

use LamPocketVN\PlayerAuto\PlayerAuto;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class AutoSell implements Listener{
	private PlayerAuto $plugin;

	/**
	 * AutoSell constructor.
	 *
	 * @param PlayerAuto $plugin
	 */
	public function __construct(PlayerAuto $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @param BlockBreakEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onBreak(BlockBreakEvent $event){
		$player = $event->getPlayer();
		if($this->plugin->isAutoFeed($player)){
			foreach($event->getDrops() as $drop){
				if(!$player->getInventory()->canAddItem($drop)){
					$this->plugin->getServer()->dispatchCommand($player, $this->plugin->getSetting()['setting']['sell-cmd']);
					$player->sendMessage($this->plugin->getSetting()['msg']['auto-sell']);
					break;
				}
			}
		}

	}
}