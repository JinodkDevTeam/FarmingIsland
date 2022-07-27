<?php
declare(strict_types=1);

namespace CustomItems\item;

use CustomItems\item\utils\Rarity;
use pocketmine\item\Item;

class MetaLessItem extends CustomItem{
	protected Item $item;

	public function __construct(CustomItemIdentifier $identifier, Item $item){
		$this->item = $item;
		parent::__construct($identifier, $item->getName(), Rarity::COMMON());
	}

	public function getName() : string{
		return $this->toItem()->getName();
	}

	public function toItem() : Item{
		return $this->item;
	}
}