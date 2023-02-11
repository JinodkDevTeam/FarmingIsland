<?php
declare(strict_types=1);

namespace NgLam2911\FI_Protect\settings;

use InvalidArgumentException;
use pocketmine\math\AxisAlignedBB;
use pocketmine\player\Player;
use pocketmine\world\Position;
use pocketmine\world\World;

class AreaSetting extends WorldSetting{

	protected AxisAlignedBB $area;

	/** @var string[] */
	protected array $black_list = [];

	public static function fromPositions(Position $pos1, Position $pos2) : self{
		if($pos1->getWorld() !== $pos2->getWorld()){
			throw new InvalidArgumentException("Position 1 and Position 2 must be in the same world");
		}
		$world = $pos1->getWorld();
		$area = new AxisAlignedBB($pos1->x, $pos1->y, $pos1->z, $pos2->x, $pos2->y, $pos2->z);
		return new AreaSetting($world, $area);
	}

	public function __construct(World $world, AxisAlignedBB $area){
		parent::__construct($world);
	}

	public function getArea() : AxisAlignedBB{
		return $this->area;
	}

	public function isInside(Position $pos) : bool{
		return $this->area->isVectorInside($pos);
	}

	public function isBlackListed(Player $player) : bool{
		return in_array($player->getUniqueId()->toString(), $this->black_list);
	}

	public function addToBlackList(Player $player) : void{
		if(!$this->isBlackListed($player)){
			$this->black_list[] = $player->getXuid();
		}
	}

	public function removeFromBlackList(Player $player) : void{
		if($this->isBlackListed($player)){
			unset($this->black_list[array_search($player->getUniqueId()->toString(), $this->black_list)]);
		}
	}

	public function getBlackList() : array{
		return $this->black_list;
	}

	public function setBlackList(array $black_list) : void{
		$this->black_list = $black_list;
	}
}