<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator\overworld\decorator;

use muqsit\vanillagenerator\generator\Decorator;
use muqsit\vanillagenerator\generator\object\Lake;
use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\world\ChunkManager;
use pocketmine\world\format\Chunk;
use Random;

class LakeDecorator extends Decorator{

	/**
	 * Creates a lake decorator.
	 *
	 * @param Block $type
	 * @param int   $rarity
	 * @param int   $base_offset
	 */
	public function __construct(
		private Block $type,
		private int $rarity,
		private int $base_offset = 0
	){
	}

	public function decorate(ChunkManager $world, Random $random, int $chunk_x, int $chunk_z, Chunk $chunk) : void{
		if($random->nextBoundedInt($this->rarity) === 0){
			$source_x = ($chunk_x << 4) + $random->nextBoundedInt(16);
			$source_z = ($chunk_z << 4) + $random->nextBoundedInt(16);
			$source_y = $random->nextBoundedInt($world->getMaxY() - $this->base_offset) + $this->base_offset;
			if($this->type->getId() === BlockLegacyIds::STILL_LAVA && ($source_y >= 64 || $random->nextBoundedInt(10) > 0)){
				return;
			}
			while($world->getBlockAt($source_x, $source_y, $source_z)->getId() === BlockLegacyIds::AIR && $source_y > 5){
				--$source_y;
			}
			if($source_y >= 5){
				(new Lake($this->type))->generate($world, $random, $source_x, $source_y, $source_z);
			}
		}
	}
}