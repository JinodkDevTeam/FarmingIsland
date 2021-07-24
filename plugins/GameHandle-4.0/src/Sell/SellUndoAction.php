<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\Sell;

use pocketmine\item\Item;
use pocketmine\player\Player;

class SellUndoAction
{
	/** @var Player */
	protected Player $player;
	/** @var float */
	private float $undoprice;
	/** @var Item[] */
	private array $items;

	/**
	 * SellUndoAction constructor.
	 *
	 * @param Player $player
	 * @param float  $undoprice
	 * @param Item[] $items
	 */
	public function __construct(Player $player, float $undoprice = 0, array $items = [])
	{
		$this->player = $player;
		$this->undoprice = $undoprice;
		$this->items = $items;
	}

	/**
	 * @return Player
	 */
	public function getPlayer(): Player
	{
		return $this->player;
	}

	/**
	 * @return int
	 */
	public function getUndoPrice(): float
	{
		return $this->undoprice;
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param Item[] $items
	 */
	public function setItems(array $items): void
	{
		$this->items = $items;
	}

	/**
	 * @param float $price
	 */
	public function setUndoPrice(float $price): void
	{
		$this->undoprice = $price;
	}
}