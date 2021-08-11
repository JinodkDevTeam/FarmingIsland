<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class CustomItem{

	protected CustomItemIdentifier $identifier;
	protected string $name;

	public function __construct(CustomItemIdentifier $identifier, string $name){
		$this->identifier = $identifier;
		$this->name = $name;
	}

	/**
	 * @return Item
	 * @description Convert to Item
	 */
	public function toItem(): Item{
		return ItemFactory::air();
	}

	public function getItemIdentifier(): CustomItemIdentifier{
		return $this->identifier;
	}

	public function getId(): int{
		return $this->getItemIdentifier()->getId();
	}

	public function getName(): string{
		return $this->name;
	}
}