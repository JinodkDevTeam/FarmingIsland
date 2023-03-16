<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area;

use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\world\Position;

class AreaManager{

	protected static AreaManager $instance;

	public static function getInstance() : AreaManager{
		return self::$instance ??= new AreaManager();
	}

	/** @var Area[] */
	protected array $areas = [];

	public function getArea(string $name) : ?Area{
		return $this->areas[$name] ?? null;
	}

	public function addArea(Area $area) : void{
		$this->areas[$area->getName()] = $area;
	}

	public function removeArea(string $name) : void{
		unset($this->areas[$name]);
	}

	public function getAreas() : array{
		return $this->areas;
	}

	public function fromPosition(Position $position) : ?Area{
		foreach($this->areas as $area){
			if ($area->getGamePos() === null){
				continue;
			}
			if ($area->getGamePos()->getWorld() === $position->getWorld()){
				if (!($area->getAreaBB() === null) && $this->isPositionInArea($area->getAreaBB(), $position)){
					return $area;
				}
			}
		}
		return null;
	}

	public function isPositionInArea(AxisAlignedBB $bb, Vector3 $vct) : bool{
		if ($vct->getX() < $bb->minX || $vct->getX() > $bb->maxX){
			return false;
		}
		if ($vct->getY() < $bb->minY || $vct->getY() > $bb->maxY){
			return false;
		}
		if ($vct->getZ() < $bb->minZ || $vct->getZ() > $bb->maxZ){
			return false;
		}
		return true;
	}
}