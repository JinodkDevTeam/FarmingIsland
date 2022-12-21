<?php
declare(strict_types=1);

namespace CustomAddons\item;

use CustomAddons\item\utils\RarityHelper;
use pocketmine\entity\projectile\Arrow;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class JujuStaff extends CustomItem{

	public function toItem() : Item{
		$item = VanillaItems::BLAZE_ROD();
		$item = $this->setEnchantGlint($item);
		$nbt = $item->getNamedTag();
		$nbt->setString("CustomItemID", $this->getNamespaceId());
		$item->setCustomName(RarityHelper::toColor($this->getRarity()) . $this->getName());
		$item->setLore([
			"",
			"§r§bAbility: §6Shortbow",
			"§r§7Instantly Shoot 10 arrows at once",
			"",
			RarityHelper::toString($this->getRarity())
		]);
		return $item;
	}

	public function onClickAir(PlayerItemUseEvent $event) : void{
		$this->shoot($event->getPlayer());
	}

	public function onInteractBlock(PlayerInteractEvent $event) : void{
		if($event->getAction() == PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			$this->shoot($event->getPlayer());
		}
	}

	public function shoot(Player $player){
		$amount = 5;
		$anglesBetween = (45 / ($amount - 1)) * M_PI / 180;
		$pitch = ($player->getLocation()->getPitch() + 90) * M_PI / 180;
		$yaw = ($player->getLocation()->getYaw() + 90 - 45 / 2) * M_PI / 180;
		$multiply = 1;
		$location = $player->getLocation();
		$location->y += $player->getEyeHeight();
		for($i = 1; $i <= $amount; $i++){
			$entity = new Arrow($location, $player, true);
			$entity->spawnToAll();
			$Direction = new Vector3((sin($pitch) * cos($yaw + $anglesBetween * $i)) * $multiply, 0.5, (sin($pitch) * sin($yaw + $anglesBetween * $i)) * $multiply);
			$entity->setMotion($Direction);
		}
	}
}