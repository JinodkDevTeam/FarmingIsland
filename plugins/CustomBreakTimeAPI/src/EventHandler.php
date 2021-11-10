<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\player\GameMode;

class EventHandler implements Listener{
	/** @var CustomBreakTimeAPI $api */
	protected CustomBreakTimeAPI $api;

	public function __construct(CustomBreakTimeAPI $api){
		$this->api = $api;
	}

	public function getAPI() : CustomBreakTimeAPI{
		return $this->api;
	}

	/**
	 * @param PlayerInteractEvent $event
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 */
	public function onInteract(PlayerInteractEvent $event) : void{
		if($event->isCancelled()){
			$this->getAPI()->setBreakStatus($event->getPlayer(), false);
		}
	}
}