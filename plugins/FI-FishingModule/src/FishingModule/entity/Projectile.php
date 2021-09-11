<?php
declare(strict_types=1);

namespace FishingModule\entity;

use pocketmine\entity\Entity;
use pocketmine\entity\projectile\Projectile as ProjectilePM;

abstract class Projectile extends ProjectilePM{
	public function getRidingEntity() : ?Entity{
		return null;
	}

	public function mountEntity(Entity $entity, int $seatNumber = 0, bool $causedByRider = true) : bool{
		/*if($this->getRidingEntity() === null and $entity !== $this and count($entity->passengers) < $entity->getSeatCount()){
			if(!isset($entity->passengers[$seatNumber])){
				if($seatNumber === 0){
					$entity->setRiddenByEntity($this);

					$this->setRiding(true);
					$entity->getNetworkProperties()->setGenericFlag(EntityMetadataFlags::WASD_CONTROLLED, true);
				}

				$this->setRotation($entity->yaw, $entity->pitch);
				$this->setRidingEntity($entity);

				$entity->passengers[$seatNumber] = $this->getId();

				$this->getNetworkProperties()->setVector3(EntityMetadataProperties::RIDER_SEAT_POSITION, $this->getRiderSeatPosition($entity)->add(0, $this->getMountedYOffset(), 0));
				$this->getNetworkProperties()->setByte(EntityMetadataProperties::CONTROLLING_RIDER_SEAT_NUMBER, $seatNumber);

				$entity->sendLink($entity->getViewers(), $this->getId(), EntityLink::TYPE_RIDER, $causedByRider);

				$entity->onRiderMount($this);

				return true;
			}
		}*/
		return false;
	}

	public function dismountEntity(bool $immediate = false) : bool{
		/*if($this->getRidingEntity() !== null){
			$entity = $this->getRidingEntity();

			unset($entity->passengers[$this->propertyManager->getByte(self::DATA_CONTROLLING_RIDER_SEAT_NUMBER)]);

			if($entity->getRiddenByEntity() === $this){
				$entity->setRiddenByEntity(null);

				$this->entityRiderYawDelta = 0;
				$this->entityRiderPitchDelta = 0;

				$this->setRiding(false);
				$entity->setGenericFlag(Entity::DATA_FLAG_WASD_CONTROLLED, false);
			}

			$this->propertyManager->removeProperty(self::DATA_RIDER_SEAT_POSITION);
			$this->propertyManager->removeProperty(self::DATA_CONTROLLING_RIDER_SEAT_NUMBER);

			$this->setRidingEntity(null);

			$entity->sendLink($entity->getViewers(), $this->getId(), EntityLink::TYPE_REMOVE, $immediate);

			$entity->onRiderLeave($this);

			return true;
		}*/
		return false;
	}


}