<?php
declare(strict_types=1);

namespace AuctionHouse\category;

use pocketmine\item\Item;

interface Category{

	public function getId(): string;

	public function getDisplayName(): string;

	public function getMenuItem(): Item;

	public function isInCategory(Item $item): bool;
}