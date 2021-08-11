<?php
declare(strict_types=1);

namespace MyPlot;

use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;
use pocketmine\world\ChunkManager;
use pocketmine\world\generator\populator\Populator;

class IslandStructure extends Populator {

	public ?MyPlotGenerator $generator = null;

	public function __construct(MyPlotGenerator $gen) {
		$this->generator = $gen;
	}

	public static function placeObject(ChunkManager $world, int $chunkX, int $chunkZ, $Xofchunk, $Zofchunk) {
		$vec = new Vector3($chunkX * 16 + $Xofchunk, 0, $chunkZ * 16 + $Zofchunk);
		$vec = $vec->subtract(7, 0, 7);
		//Begin of Island Making code
		//Base Island Center Pos: 7 64 7 (X Y Z format)
		for ($i = 6; $i < 9; $i++)
			for ($j = 6; $j < 9; $j++) {
				$world->setBlockAt($vec->x + $i, 64, $vec->z + $j, VanillaBlocks::OAK_PLANKS());
			}
		//End of Island Makeing code
	}

	public function populate(ChunkManager $world, $chunkX, $chunkZ, Random $random): void {
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z) {
			for($X = 0; $X < 16; ++$X) {
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND) {
					self::placeObject($world, $chunkX, $chunkZ, $X, $Z);
				}
			}
		}
	}
}