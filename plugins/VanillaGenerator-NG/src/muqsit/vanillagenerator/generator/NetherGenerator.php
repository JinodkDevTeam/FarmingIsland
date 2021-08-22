<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator;

use pocketmine\world\ChunkManager;
use pocketmine\world\format\BiomeArray;
use pocketmine\world\format\Chunk;
use pocketmine\world\format\PalettedBlockArray;
use pocketmine\world\format\SubChunk;
use pocketmine\world\generator\Generator;
use pocketmine\world\World;
use ReflectionException;
use ReflectionObject;

class NetherGenerator extends Generator
{
	/** @var \NetherGenerator */
	private \NetherGenerator $generator;

	public function __construct(int $seed, string $preset)
	{
		parent::__construct($seed, $preset);

		print "Starting NetherGenerator" . PHP_EOL;
		$this->generator = new \NetherGenerator($seed);
		print "OK" . PHP_EOL;
	}

	public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
	{
		$chunk = $world->getChunk($chunkX, $chunkZ);

		$biomeData = $chunk->getBiomeIdArray();
		$pelletedEntries = [];

		foreach ($chunk->getSubChunks() as $y => $subChunk) {
			if (!$subChunk->isEmptyFast()) {
				$pelletedEntries[$y] = $subChunk->getBlockLayers()[0];
			} else {
				$newSubChunk = new SubChunk($subChunk->getEmptyBlockId(), [new PalettedBlockArray($subChunk->getEmptyBlockId())], $subChunk->getBlockSkyLightArray(), $subChunk->getBlockLightArray());
				$chunk->setSubChunk($y, $newSubChunk);

				$pelletedEntries[$y] = $newSubChunk->getBlockLayers()[0];
			}
		}

		$biomes = $this->generator->generateChunk($pelletedEntries, $biomeData, World::chunkHash($chunkX, $chunkZ));

		(function () use ($biomes): void {
			/** @noinspection PhpUndefinedFieldInspection */
			/** @phpstan-ignore-next-line */
			$this->biomeIds = new BiomeArray($biomes);
		})->call($chunk);
	}

	/**
	 * @throws ReflectionException
	 */
	public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
	{
		$r = new ReflectionObject($world);
		$p = $r->getProperty('chunks');
		$p->setAccessible(true);

		$biomeEntries = [];
		$pelletedEntries = [];
		$dirtyEntries = [];

		/**
		 * @var int $hash
		 * @var Chunk $chunkVal
		 */
		foreach ($p->getValue($world) as $hash => $chunkVal) {
			World::getXZ($hash, $x, $z);

			$array = [];

			foreach ($chunkVal->getSubChunks() as $y => $subChunk) {
				if (!$subChunk->isEmptyFast()) {
					$array[$y] = $subChunk->getBlockLayers()[0];
				} else {
					$newSubChunk = new SubChunk($subChunk->getEmptyBlockId(), [new PalettedBlockArray($subChunk->getEmptyBlockId())], $subChunk->getBlockSkyLightArray(), $subChunk->getBlockLightArray());
					$chunkVal->setSubChunk($y, $newSubChunk);

					$array[$y] = $newSubChunk->getBlockLayers()[0];
				}
			}

			$pelletedEntries[$hash] = $array;
			$biomeEntries[$hash] = $chunkVal->getBiomeIdArray();
			$dirtyEntries[$hash] = $chunkVal->isDirty();
		}

		$this->generator->populateChunk($pelletedEntries, $biomeEntries, $dirtyEntries, World::chunkHash($chunkX, $chunkZ));

		foreach ($dirtyEntries as $hash => $dirtyEntry) {
			World::getXZ($hash, $x, $z);

			if ($dirtyEntry) {
				$world->getChunk($x, $z)->setDirty();
			}
		}
	}
}