<?php
declare(strict_types=1);

namespace CustomItems\item\fishingrod;

use CustomItems\item\utils\RarityHelper;
use FishingModule\event\EntityFishEvent;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;

class GrapplingHook extends CustomRod{

	public function toItem() : Item{
		$item = VanillaItems::FISHING_ROD();
		if ($item instanceof Durable){
			$item->setUnbreakable();
		}
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onFish(EntityFishEvent $event) : void{
		if ($event->getState() !== EntityFishEvent::STATE_FISHING){
			$hook_pos = $event->getFishingHook()->getPosition();
			$entity_pos = $event->getEntity()->getPosition();
			$entity_pos->y += $event->getEntity()->getEyeHeight();
			$ux = $entity_pos->x - $hook_pos->x;
			$uy = $entity_pos->y - $hook_pos->y;
			$uz = $entity_pos->z - $hook_pos->z;
			$u = new Vector3($ux, $uy, $uz);

			$event->getEntity()->setMotion($u->multiply(-0.5));
			$event->cancel();
		}
	}
}