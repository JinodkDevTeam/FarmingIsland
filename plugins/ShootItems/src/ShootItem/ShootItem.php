<?php
declare(strict_types=1);

namespace ShootItem;

use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;

class ShootItem extends PluginBase implements Listener
{
	/** @var bool[] */
	public array $pickup = [];
	/** @var ClosureTask[] */
	public array $task = [];

	/**
	 * @param PlayerItemUseEvent $event
	 * @priority HIGHEST
	 * @handleCancelled false
	 */
	public function onItemUse (PlayerItemUseEvent $event)
	{
		//Yeah, it really "cLeAn".
		$player = $event->getPlayer();
		$direction = $event->getDirectionVector();
		$item = $event->getItem();
		if ($item->getId() == ItemIds::AIR) return;
		$pos = $player->getLocation();
		$pos->y += $player->getEyeHeight();
		$shootitem = clone $item;
		$entity = new ItemEntity($pos, $shootitem->setCount(1), null);
		$player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($item->getCount() - 1));
		$entity->setMotion($direction->multiply(3));
		$entity->spawnToAll();
		$this->pickup[$player->getName()] = false;
		if (isset($this->task[$player->getName()]))
		{
			$this->task[$player->getName()]->getHandler()->cancel();
		}
		$this->task[$player->getName()] = new ClosureTask(function() use ($player) : void
		{
			$this->pickup[$player->getName()] = true;
			unset($this->task[$player->getName()]);
		});
		$this->getScheduler()->scheduleDelayedTask($this->task[$player->getName()], 40);
	}

	/**
	 * @param EntityItemPickupEvent $event
	 * @priority LOWEST
	 * @handleCancelled false
	 */
	public function onPickup(EntityItemPickupEvent $event)
	{
		$viewer = $event->getEntity();
		if (!$viewer instanceof Player) return;
		if(!isset($this->pickup[$viewer->getName()])) return;
		if(!$this->pickup[$viewer->getName()]){
			$event->cancel();
		}
	}

	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
}
