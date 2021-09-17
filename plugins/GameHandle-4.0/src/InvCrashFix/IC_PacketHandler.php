<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\InvCrashFix;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\ContainerClosePacket;

class IC_PacketHandler implements Listener{
	private bool $cancel_send = true;

	/**
	 * @param DataPacketReceiveEvent $event
	 *
	 * @priority NORMAL
	 * @ignoreCancelled true
	 */
	public function onRecieve(DataPacketReceiveEvent $event){
		$packet = $event->getPacket();
		if($packet instanceof ContainerClosePacket){
			$this->cancel_send = false;
			$event->getOrigin()->sendDataPacket($packet, false);
			$this->cancel_send = true;
		}
	}

	/**
	 * @param DataPacketSendEvent $event
	 *
	 * @priority NORMAL
	 * @ignoreCancelled true
	 */
	public function onSend(DataPacketSendEvent $event){
		if(($event->getPackets() instanceof ContainerClosePacket) && $this->cancel_send){
			$event->cancel();
		}
	}
}