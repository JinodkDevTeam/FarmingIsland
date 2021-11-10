<?php
declare(strict_types=1);

namespace FishingModule\entity;

use FishingModule\event\PlayerFishEvent;
use FishingModule\Loader;
use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Projectile;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class FishingHook extends Projectile{

	protected $gravity = 0.1;

	protected function getInitialSizeInfo() : EntitySizeInfo{ return new EntitySizeInfo(0.15, 0.15); }

	public static function getNetworkTypeId() : string{ return EntityIds::FISHING_HOOK; }

	public function onRetraction() : void{
		$result = [];
		$ev = new PlayerFishEvent(Loader::getInstance(), $this->getOwningEntity(), $this, PlayerFishEvent::STATE_CAUGHT_FISH, 100, $result);
		if (!$ev->isCancelled()){
			$this->getOwningEntity()->getPosition()->getWorld()->dropExperience($this->getOwningEntity()->getPosition(), $ev->getXpDropAmount());
		}

		$this->flagForDespawn();
	}
}