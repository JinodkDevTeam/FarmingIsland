<?php
declare(strict_types = 1);

namespace BlockHorizons\BlockPets\pets\creatures;

use BlockHorizons\BlockPets\pets\WalkingPet;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;

class PandaPet extends WalkingPet {

	const NETWORK_NAME = "PANDA_PET";
	const NETWORK_ORIG_ID = EntityIds::PANDA;

	//TODO: Panda Genes

	protected float $height = 1.5;
	protected float $width = 1.7;

	protected string $name = "Panda Pet";
}