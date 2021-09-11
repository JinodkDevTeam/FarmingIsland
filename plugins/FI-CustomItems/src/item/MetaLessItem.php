<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

class MetaLessItem extends CustomItem{
	protected MetaLessIdentifier $metaLessIdentifier;

	public function __construct(CustomItemIdentifier $identifier, MetaLessIdentifier $metaLessIdentifier){
		$this->metaLessIdentifier = $metaLessIdentifier;
		parent::__construct($identifier, "", RarityType::COMMON);
	}

	public function getName() : string{
		return $this->toItem()->getName();
	}

	public function toItem() : Item{
		return ItemFactory::getInstance()->get($this->getMetaLessIdentifier()->getId(), $this->getMetaLessIdentifier()->getMeta());
	}

	public function getMetaLessIdentifier() : MetaLessIdentifier{
		return $this->metaLessIdentifier;
	}
}