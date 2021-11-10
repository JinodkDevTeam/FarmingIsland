<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\RarityHelper;
use pocketmine\block\Block;
use pocketmine\block\Leaves;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class Crook extends CustomItem{

	public array $isBreaking = [];
	public array $breaked = [];

	public function toItem() : Item{
		$item = VanillaItems::STICK();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setInt("CustomItemID", $this->getId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§7A forceful stick which can\nbreak a large amount of leaves\nin a single hit.",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onDestroyBlock(BlockBreakEvent $event) : void{
		$player = $event->getPlayer();
		$item = $event->getItem();
		$block = $event->getBlock();
		if($block instanceof Leaves){
			if($this->isBreaking($player)){
				return;
			}
			$this->isBreaking[$player->getName()] = true;
			$this->breaked[$player->getName()] = 0;
			$this->CrookMine($block, $item, $player);
			$this->breaked[$player->getName()] = 0;
			$this->isBreaking[$player->getName()] = false;
		}
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
	 */
	public function CrookMine(Block $blockbreak, Item $item, Player $player){
		$pending = [];
		$pos = $blockbreak;

		while(true){
			if($this->breaked[$player->getName()] > 100){
				break;
			}
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
					if($side instanceof Leaves){
						if(!$this->isChecked($side, $pending)){
							array_push($blocks, $side);
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