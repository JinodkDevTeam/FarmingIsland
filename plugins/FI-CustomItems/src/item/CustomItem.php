<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\Rarity;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerEntityInteractEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class CustomItem{

	protected CustomItemIdentifier $identifier;
	protected string $name;
	protected Rarity $rarity;

	public function __construct(CustomItemIdentifier $identifier, string $name, Rarity $rarity){
		$this->identifier = $identifier;
		$this->name = $name;
		$this->rarity = $rarity;
	}

	/**
	 * @return Item
	 * @description Convert to Item
	 */
	public function toItem() : Item{
		return ItemFactory::air();
	}

	public function getNamespaceId() : string{
		return $this->getItemIdentifier()->getNamespaceId();
	}

	public function getItemIdentifier() : CustomItemIdentifier{
		return $this->identifier;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getRarity() : Rarity{
		return $this->rarity;
	}

	public function setEnchantGlint(Item $item) : Item{
		$item->addEnchantment(new EnchantmentInstance(EnchantmentIdMap::getInstance()->fromId(100), 1));
		return $item;
	}

	public function onInteractBlock(PlayerInteractEvent $event) : void{ }

	public function onClickAir(PlayerItemUseEvent $event) : void{ }

	public function onAttackEntity(EntityDamageByEntityEvent $event) : void{ }

	public function onInteractEntity(PlayerEntityInteractEvent $event) : void{ }

	public function onSneak(PlayerToggleSneakEvent $event): void{ }

	public function onPlace(BlockPlaceEvent $event): void{
		$event->cancel();
	}
}