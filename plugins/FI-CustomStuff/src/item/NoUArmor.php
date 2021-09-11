<?php
declare(strict_types=1);

namespace CustomStuff\item;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class NoUArmor implements Listener{

	public function onDamage(EntityDamageEvent $event){
		$entity = $event->getEntity();
		if(!$entity instanceof Player){
			return;
		}
		$armorinv = $entity->getArmorInventory();
		foreach($armorinv->getContents() as $item){
			$nbt = $item->getNamedTag();
			if($nbt->getTag("CustomItem") == null){
				continue;
			}
			if($nbt->getTag("CustomItem")->getValue() == "NoUArmor"){
				$event->setBaseDamage(0);
				break;
			}
		}
	}
}
