<?php
declare(strict_types=1);

namespace IslandMaker;

use InvalidArgumentException;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\Position;

class Loader extends PluginBase{

	//AIR: Ignored.
	//Barrier: AIR

	public const NONE = 0;
	public const POS1 = 1;
	public const POS2 = 2;

	/** @var Block[] */
	public array $data = [];
	/** @var Vector3|null */
	public ?Vector3 $spawn_point = null;
	public ?Position $pos1 = null;
	public ?Position $pos2 = null;

	/** @var int[] */
	public array $status = [];

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getServer()->getCommandMap()->register("ismaker", new IsMakerCommand($this));
	}

	public function generate() : void{
		new IsCodeGenerator($this->getDataFolder(), $this->data, $this->spawn_point);
	}

	public function make() : void{
		$this->data = [];
		if($this->pos1 == null){
			throw new InvalidArgumentException("Unknow pos1");
		}
		if($this->pos2 == null){
			throw new InvalidArgumentException("Unknow pos2");
		}
		if($this->pos1->getWorld() !== $this->pos2->getWorld()){
			throw new InvalidArgumentException("2 pos is not in the same world !");
		}
		$world = $this->pos1->getWorld();
		$minX = min($this->pos1->getX(), $this->pos2->getX());
		$minY = min($this->pos1->getY(), $this->pos2->getY());
		$minZ = min($this->pos1->getZ(), $this->pos2->getZ());
		$maxX = max($this->pos1->getX(), $this->pos2->getX());
		$maxY = max($this->pos1->getY(), $this->pos2->getY());
		$maxZ = max($this->pos1->getZ(), $this->pos2->getZ());
		for($x = $minX; $x <= $maxX; $x++)
			for($y = $minY; $y <= $maxY; $y++)
				for($z = $minZ; $z <= $maxZ; $z++){
					$this->data[] = $world->getBlockAt($x, $y, $z);
				}
	}

	public function getStatus(Player $player) : int{
		if(isset($this->status[$player->getName()])){
			return $this->status[$player->getName()];
		}
		return self::NONE;
	}

	public function setStatus(Player $player, int $status) : void{
		$this->status[$player->getName()] = $status;
	}
}