<?php
declare(strict_types=1);

namespace CustomItems\listener;

use CustomItems\item\CustomItemFactory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;

class CustomItemListener implements Listener{
	/**
	 * @param BlockPlaceEvent $event
	 *
	 * @priority HIGH
	 * @handleCancelled FALSE
	 */
	public function onPlace(BlockPlaceEvent $event) : void{
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$event->cancel();
		}
	}

	/**
	 * @param PlayerInteractEvent $event
	 *
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 */
	public function onInteract(PlayerInteractEvent $event){
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			$player = $event->getPlayer();
			$blockClicked = $event->getBlock();
			$face = $event->getFace();
			$clickVector = $event->getTouchVector();
			$blockReplace = $blockClicked->getSide($face);
			$citem->onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector);
		}
	}

	/**
	 * @param PlayerItemUseEvent $event
	 *
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 */
	public function onItemUse(PlayerItemUseEvent $event){
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			$player = $event->getPlayer();
			$directionVector = $event->getDirectionVector();
			$citem->onClickAir($player, $directionVector);
		}
	}

	/**
	 * @param BlockBreakEvent $event
	 *
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 */
	public function onBreak(BlockBreakEvent $event){
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			$block = $event->getBlock();
			$citem->onDestroyBlock($block);
		}
	}
}