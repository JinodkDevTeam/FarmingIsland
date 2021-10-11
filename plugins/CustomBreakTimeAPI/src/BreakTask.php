<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class BreakTask extends Task{
	protected Player $player;
	protected Vector3 $pos;
	protected CustomBreakTimeAPI $api;

	public function __construct(Player $player, Vector3 $pos, CustomBreakTimeAPI $api){
		$this->player = $player;
		$this->pos = $pos;
		$this->api = $api;
	}

	public function getPlayer() : Player{
		return $this->player;
	}

	public function getPos() : Vector3{
		return $this->pos;
	}

	public function getAPI() : CustomBreakTimeAPI{
		return $this->api;
	}

	public function onRun() : void{
		if(!$this->getAPI()->isBreaking($this->player)) return;
		$item = $this->getPlayer()->getInventory()->getItemInHand();
		CustomBreakTimeAPI::getBaseBreakTime($item)->onBreak($this->getPos(), $item, $this->getPlayer());
	}

	public function cancel(){
		$this->getHandler()?->cancel();
	}
}
