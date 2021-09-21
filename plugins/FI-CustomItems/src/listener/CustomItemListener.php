<?php
declare(strict_types=1);

namespace CustomItems\listener;

use CustomItems\item\CustomItemFactory;
use pocketmine\entity\Human;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerEntityInteractEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemUseResult;

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
	 * @priority HIGHEST
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
			if ($citem->onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector) === ItemUseResult::FAIL()){
				$event->cancel();
			}
		}
	}

	/**
	 * @param PlayerItemUseEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onItemUse(PlayerItemUseEvent $event){
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			$player = $event->getPlayer();
			$directionVector = $event->getDirectionVector();
			if ($citem->onClickAir($player, $directionVector) === ItemUseResult::FAIL()){
				$event->cancel();
			}
		}
	}

	/**
	 * @param BlockBreakEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onBreak(BlockBreakEvent $event){
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			$block = $event->getBlock();
			if ($citem->onDestroyBlock($block) === ItemUseResult::FAIL()){
				$event->cancel();
			}
		}
	}

	/**
	 * @param EntityDamageByEntityEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onDamage(EntityDamageByEntityEvent $event){
		$victim = $event->getEntity();
		$damager = $event->getDamager();
		if ($damager instanceof Human){
			$item = $damager->getInventory()->getItemInHand();
			if($item->getNamedTag()->getTag("CustomItemID") !== null){
				$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
				if($citem == null) return;

				if ($citem->onAttackEntity($damager, $victim) === ItemUseResult::FAIL()){
					$event->cancel();
				}
			}
		}
	}

	/**
	 * @param PlayerEntityInteractEvent $event
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onEntityInteract(PlayerEntityInteractEvent $event){
		$target = $event->getEntity();
		$player = $event->getPlayer();
		$clickVector = $event->getClickPosition();
		$item = $player->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;

			if ($citem->onInteractEntity($player, $target, $clickVector) === ItemUseResult::FAIL()){
				$event->cancel();
			}
		}
	}

}