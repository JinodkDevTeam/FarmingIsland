<?php
declare(strict_types=1);

namespace NgLam2911\FI_Protect\settings;
use pocketmine\world\World;

class WorldSetting{

	protected World $world;

	protected bool $isLocked = false;
	protected bool $isProtected = false;
	protected bool $isAllowPvP = true;

	public function __construct(World $world){
		$this->world = $world;
	}

	public function getWorld() : World{
		return $this->world;
	}

	public function isLocked() : bool{
		return $this->isLocked;
	}

	public function isAllowPvP() : bool{
		return $this->isAllowPvP;
	}

	public function isProtected() : bool{
		return $this->isProtected;
	}

	public function setLock(bool $status = true) : void{
		$this->isLocked = $status;
	}

	public function setProtect(bool $status = true) : void{
		$this->isProtected = $status;
	}

	public function setAllowPvP(bool $status = true) : void{
		$this->isAllowPvP = $status;
	}
}