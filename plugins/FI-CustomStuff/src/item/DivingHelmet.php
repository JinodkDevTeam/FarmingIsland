<?php
declare(strict_types=1);

namespace CustomStuff\item;

use CustomStuff\CustomStuff;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class DivingHelmet implements Listener{
	public CustomStuff $core;

	public function __construct(CustomStuff $core){
		$this->core = $core;
	}


	/*public function onArmorChange (InventoryTransactionEvent $event) //TODO: Check armor update.
	{
		$entity = $event->getEntity();
		if (!$entity instanceof Player)
		{
			return;
		}
		if ($event->getSlot() !== ArmorInventory::SLOT_HEAD)
		{
			return;
		}
		$item = $event->getNewItem();
		$nbt = $item->getNamedTag();
		if (!$nbt->hasTag("CustomItem"))
		{
			$this->removeEffect($entity);
			return;
		}
		if ($nbt->getTag("CustomItem")->getValue() == "DivingHelmet")
		{
			$this->addEffect($entity);
		}
		else
		{
			$this->removeEffect($entity);
		}
	}*/

	public function addEffect(Player $player){
		$effect = VanillaEffects::WATER_BREATHING();
		$player->getEffects()->add(new EffectInstance($effect, 2147483647, 0, false));
	}

	public function removeEffect(Player $player){
		if($player->getEffects()->has(VanillaEffects::WATER_BREATHING())){
			$player->getEffects()->remove(VanillaEffects::WATER_BREATHING());
		}
	}
}
