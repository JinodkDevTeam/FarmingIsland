<?php
declare(strict_types=1);

namespace CustomAddons\item;

use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\player\Player;

class VeinMineTool extends CustomTool{

	/** @var bool[] */
	public array $isBreaking = [];
	/** @var int[] */
	public array $breaked = [];

	public function getBreakLimit() : int{
		return 100;
	}

	/**
	 * @return Block[]
	 */
	public function getBreakBlocks() : array{
		return [];
	}

	public function onDestroyBlock(BlockBreakEvent $event) : void{
		$player = $event->getPlayer();
		$item = $event->getItem();
		$block = $event->getBlock();
		if($this->isCompative($block)){
			if($this->isBreaking($player)){
				return;
			}
			$this->isBreaking[$player->getName()] = true;
			$this->breaked[$player->getName()] = 1; //Its already breaked 1 blocks.
			$this->VeinMine($block, $item, $player);
			$this->breaked[$player->getName()] = 0;
			$this->isBreaking[$player->getName()] = false;
		}
	}

	public function isCompative(Block $block) : bool{
		foreach($this->getBreakBlocks() as $data){
			if ($block->isSameType($data)){
				return true;
			}
		}
		return false;
	}

	public function isBreaking(Player $player) : bool{
		if(isset($this->isBreaking[$player->getName()])){
			return $this->isBreaking[$player->getName()];
		}else return false;
	}

	/**
	 * @param Block  $blockbreak
	 * @param Item   $item
	 * @param Player $player
	 *
	 * @description Algorithm design by JINODK
	 * @description Code design by NgLam2911
	 */
	public function VeinMine(Block $blockbreak, Item $item, Player $player){
		$pending = [];
		$pos = $blockbreak;
		while($this->breaked[$player->getName()] <= $this->getBreakLimit()){
			$sides = $this->getAllSide($pos, $pending);
			if($sides !== []){
				$pending = array_merge($pending, $sides);
			}

			if($pos !== $blockbreak){
				$pos->getPosition()->getWorld()->useBreakOn($pos->getPosition()->asVector3(), $item, $player, true);
				$this->breaked[$player->getName()]++;
			}

			if(!isset($pending)){
				break;
			}
			if($pending == []){
				break;
			}

			$pos = $pending[0];
			unset($pending[0]);
			$pending = array_values($pending);
		}
	}

	public function getAllSide(Block $block, array $pending) : array{
		$blocks = [];
		for($x = $block->getPosition()->getX() - 1; $x <= $block->getPosition()->getX() + 1; $x++)
			for($y = $block->getPosition()->getY() - 1; $y <= $block->getPosition()->getY() + 1; $y++)
				for($z = $block->getPosition()->getZ() - 1; $z <= $block->getPosition()->getZ() + 1; $z++){
					if($x == $block->getPosition()->getX() and $y == $block->getPosition()->getY() and $z == $block->getPosition()->getZ()){
						continue;
					}
					$side = $block->getPosition()->getWorld()->getBlockAt($x, $y, $z);
					if($this->isCompative($side)){
						if(!$this->isChecked($side, $pending)){
							$blocks[] = $side;
						}
					}
				}
		return $blocks;
	}

	public function isChecked(Block $block, array $pending) : bool{
		if(in_array($block, $pending)) return true;
		return false;
	}
}