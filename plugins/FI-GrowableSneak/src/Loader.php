<?php
declare(strict_types=1);

namespace GrowableSneak;

use pocketmine\block\Block;
use pocketmine\block\Sapling;
use pocketmine\block\utils\TreeType;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Random;
use pocketmine\world\generator\object\Tree;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\Position;

class Loader extends PluginBase implements Listener{
	const RADIUS = 5;

	public function onEnable() : void{
		parent::onEnable();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param PlayerToggleSneakEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onSneak(PlayerToggleSneakEvent $event){
		if($event->isCancelled()){
			return;
		}
		if(!$event->isSneaking()){
			true;
		}
		$this->getArea($event->getPlayer()->getPosition());
	}

	public function getArea(Position $position){
		$x = $position->getX();
		$y = $position->getY();
		$z = $position->getZ();
		$world = $position->getWorld();
		$radius = self::RADIUS;
		for($i = $x - $radius; $i <= $x + $radius; $i++)
			for($j = $y - $radius; $j <= $y + $radius; $j++)
				for($k = $z - $radius; $k <= $z + $radius; $k++){
					$block = $world->getBlockAt((int) $i, (int) $j, (int) $k);
					$this->growTree($block);
				}
	}

	public function growTree(Block $block){
		if(!($block instanceof Sapling)){
			return;
		}
		if(mt_rand(1, 20) === 5){
			$random = new Random(mt_rand(1, 20));
			Tree::growTree($block->getPosition()->getWorld(), $block->getPosition()->getX(), $block->getPosition()->getY(), $block->getPosition()->getZ(), $random, TreeType::fromMagicNumber($block->getMeta()));
		}else{
			$pos = $block->getPosition()->asVector3();
			$pos->y++;
			$block->getPosition()->getWorld()->addParticle($pos, new HappyVillagerParticle());
		}
	}
}