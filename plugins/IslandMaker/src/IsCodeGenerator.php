<?php
declare(strict_types=1);

namespace IslandMaker;

use InvalidArgumentException;
use pocketmine\block\Air;
use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\math\Vector3;
use RuntimeException;

class IsCodeGenerator{

	/** @var Block[] */
	protected array $data = [];
	protected Vector3 $spawn_point;
	protected Vector3 $base_pos;
	protected string $dir;

	public function __construct(string $dir, array $data, Vector3 $spawn_point, ?Vector3 $base_pos = null){
		$this->data = $data;
		$this->spawn_point = new Vector3((int)$spawn_point->x, (int)$spawn_point->y, (int)$spawn_point->z);
		if ($base_pos == null){
			$this->base_pos = new Vector3(7, 64, 7);
		}
		$this->dir = $dir;

		$this->generate();
	}

	public function generate(): void{
		if (empty($this->data)){
			throw new RuntimeException("Data is empty !");
		}
		$file = fopen($this->dir . "IslandBaseStructure.php", "w");
		if ($file == false){
			throw new RuntimeException("Cant create or write into file !");
		}
		$cmt = [
			"<?php",
			"",
			"/**",
			" * Generate by FI-IslandMaker",
			" * Date: " . date("j-n-Y H:i:s", time()),
			" */",
			"",
			""
		];
		fwrite($file, implode(PHP_EOL, $cmt));
		foreach($this->data as $block){
			if (!$block instanceof Block){
				throw new InvalidArgumentException("Given data of blocks it not a block !");
			}
			if ($block instanceof Air){
				continue;
			}
			$id = $block->getId();
			if ($block->getId() == BlockLegacyIds::BARRIER){
				$id = 0; //AIR
			}
			$pos = $block->getPosition();
			$meta = $block->getMeta();
			$pos = $pos->subtractVector($this->spawn_point);
			$pos = $pos->addVector($this->base_pos);
			$data = "$"."world->setBlockAt($"."vec->x + ".$pos->x.", ".$pos->y.", $"."vec->z + ".$pos->z.", BlockFactory::getInstance()->get(".$id.", ".$meta."));";
			fwrite($file, $data . PHP_EOL);
		}
		fclose($file);
	}
}