<?php
declare(strict_types=1);

namespace GrowableSneak;

use pocketmine\block\Block;
use pocketmine\block\Sapling;
use pocketmine\block\utils\TreeType;
use pocketmine\event\block\StructureGrowEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Random;
use pocketmine\world\generator\object\TreeFactory;
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
		if(!$block instanceof Sapling){
			return;
		}
		if(mt_rand(1, 20) === 5){
			$this->grow($block);
		}else{
			$pos = $block->getPosition()->asVector3();
			$pos->y++;
			$block->getPosition()->getWorld()->addParticle($pos, new HappyVillagerParticle());
		}
	}

	public function grow(Sapling $sapling) : void{
		$random = new Random(mt_rand());
		$tree = TreeFactory::get($random, TreeType::fromMagicNumber($sapling->getMeta()));
		$transaction = $tree?->getBlockTransaction($sapling->getPosition()->getWorld(), $sapling->getPosition()->getFloorX(), $sapling->getPosition()->getFloorY(), $sapling->getPosition()->getFloorZ(), $random);
		if($transaction === null){
			return;
		}

		$ev = new StructureGrowEvent($sapling, $transaction);
		$ev->call();
		if($ev->isCancelled()){
			return;
		}

		$transaction->apply();
	}
}