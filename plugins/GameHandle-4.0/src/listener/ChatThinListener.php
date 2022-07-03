<?php

//ORIGINAL CODE: ChatThin by PresentKim
//https://github.com/PresentKim/ChatThin

declare(strict_types=1);

namespace NgLamVN\GameHandle\listener;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\utils\TextFormat;

class ChatThinListener implements Listener{
	public const THIN_TAG = TextFormat::ESCAPE . "　";

	/**
	 * @param DataPacketSendEvent $event
	 *
	 * @priority HIGHEST
	 */
	public function onPacketSend(DataPacketSendEvent $event) : void{
		$pks = $event->getPackets();
		foreach($pks as $pk)
			if($pk instanceof TextPacket){
				if($pk->type === TextPacket::TYPE_TIP || $pk->type === TextPacket::TYPE_POPUP || $pk->type === TextPacket::TYPE_JUKEBOX_POPUP)
					return;

				if($pk->type === TextPacket::TYPE_TRANSLATION){
					$pk->message = $this->toThin($pk->message);
				}else{
					$pk->message .= self::THIN_TAG;
				}
			}elseif($pk instanceof AvailableCommandsPacket){
				foreach($pk->commandData as $commandData){
					$commandData->description = $this->toThin($commandData->description);
				}
			}
	}

	public function toThin(string $str) : string{
		return preg_replace("/%*(([a-z\d_]+\.)+[a-z\d_]+)/i", "%$1", $str) . self::THIN_TAG;
	}
}
