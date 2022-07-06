<?php
declare(strict_types=1);

namespace CustomItems\listener;

use CustomItems\item\armor\CustomBoots;
use CustomItems\item\CustomItem;
use CustomItems\item\CustomItemFactory;
use CustomItems\item\fishingrod\CustomRod;
use CustomItems\item\CustomTool;
use FishingModule\event\EntityFishEvent;
use FishingModule\event\FishingHookHookEvent;
use pocketmine\entity\Human;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerEntityInteractEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;

class CustomItemListener implements Listener{
	/**
	 * @param BlockPlaceEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onPlace(BlockPlaceEvent $event) : void{
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			$citem->onPlace($event);
		}
	}

	/**
	 * @param PlayerInteractEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onInteract(PlayerInteractEvent $event): void{
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			$citem->onInteractBlock($event);
		}
	}

	/**
	 * @param PlayerItemUseEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onItemUse(PlayerItemUseEvent $event): void{
		$item = $event->getItem();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			$citem->onClickAir($event);
		}
	}

	/**
	 * @param BlockBreakEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onBreak(BlockBreakEvent $event): void{
		$item = $event->getPlayer()->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			if ($citem instanceof CustomTool){
				$citem->onDestroyBlock($event);
			}
		}
	}

	/**
	 * @param EntityDamageByEntityEvent $event
	 *
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onDamage(EntityDamageByEntityEvent $event): void{
		$damager = $event->getDamager();
		if ($damager instanceof Human){
			$item = $damager->getInventory()->getItemInHand();
			if($item->getNamedTag()->getTag("CustomItemID") !== null){
				$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
				if($citem == null) return;
				$citem->onAttackEntity($event);
			}
		}
	}

	/**
	 * @param PlayerEntityInteractEvent $event
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onEntityInteract(PlayerEntityInteractEvent $event): void{
		$player = $event->getPlayer();
		$item = $player->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			$citem->onInteractEntity($event);
		}
	}

	/**
	 * @param FishingHookHookEvent $event
	 * @priority LOWEST
	 * @description Handle onHook event for CustomRod items
	 */
	public function onHook(FishingHookHookEvent $event){
		$player = $event->getEntity();
		$item = $player->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			if ($citem instanceof CustomRod){
				$citem->onHook($event);
			}
		}
	}

	public function onFish(EntityFishEvent $event){
		$player = $event->getEntity();
		$item = $player->getInventory()->getItemInHand();
		if($item->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			if ($citem instanceof CustomRod){
				$citem->onFish($event);
			}
		}
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		//TODO: HELMET
		//TODO: CHESTPLATE
		//TODO: LEGGINGS
		//BOOTS ABILITY HANDLER
		$boots = $player->getArmorInventory()->getBoots();
		if($boots->getNamedTag()->getTag("CustomItemID") !== null){
			$citem = CustomItemFactory::getInstance()->get((int) $boots->getNamedTag()->getTag("CustomItemID")->getValue());
			if($citem == null) return;
			if ($citem instanceof CustomBoots){
				$citem->onMove($event);
			}
		}
	}

	/**
	 * @param PlayerToggleSneakEvent $event
	 * @priority LOWEST
	 * @description Handle onSneak event for CustomItems
	 * @handleCancelled FALSE
	 */
	public function onSneak(PlayerToggleSneakEvent $event) : void{
		$player = $event->getPlayer();
		$items = $player->getArmorInventory()->getContents();
		$items = array_merge($items, [$player->getInventory()->getItemInHand()]);
		foreach($items as $item){
			if($item->getNamedTag()->getTag("CustomItemID") !== null){
				$citem = CustomItemFactory::getInstance()->get((int) $item->getNamedTag()->getTag("CustomItemID")->getValue());
				if($citem == null) return;
				if ($citem instanceof CustomItem){
					$citem->onSneak($event);
				}
			}
		}
	}
}