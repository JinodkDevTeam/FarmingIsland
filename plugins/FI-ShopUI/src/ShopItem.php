<?php
declare(strict_types=1);

namespace ShopUI;

use pocketmine\item\Item;

class ShopItem{

	protected Item $item;
	protected float $buy;
	protected float $sell;
	protected string $icon;

	public function __construct(Item $item, float $buy, float $sell, string $icon){
		$this->item = $item;
		$this->buy = $buy;
		$this->sell = $sell;
		$this->icon = $icon;
	}

	public function getItem(): Item{
		return $this->item;
	}

	public function getBuyPrice(): float{
		return $this->buy;
	}

	public function getSellPrice(): float{
		return $this->sell;
	}

	public function getIconLink(): string{
		return $this->icon;
	}
}