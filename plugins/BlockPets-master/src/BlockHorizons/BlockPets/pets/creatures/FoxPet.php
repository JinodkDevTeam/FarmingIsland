<?php
declare(strict_types = 1);

namespace BlockHorizons\BlockPets\pets\creatures;

use BlockHorizons\BlockPets\pets\SmallCreature;
use BlockHorizons\BlockPets\pets\WalkingPet;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class FoxPet extends WalkingPet implements SmallCreature {

	const NETWORK_NAME = "FOX_PET";
	const NETWORK_ORIG_ID = EntityIds::FOX;

	const FOX_TYPE = 17;

	const TYPE_RED = 0;
	const TYPE_SNOW = 1;

	protected string $name = "Fox Pet";

	protected float $width = 0.6;
	protected float $height = 0.85;

	public function getRandomType(): int {
		return array_rand([
			self::TYPE_RED,
			self::TYPE_SNOW
		]);
	}

	public function generateCustomPetData(): void {
		$this->getNetworkProperties()->setInt(self::FOX_TYPE, $this->getRandomType());
	}
}
