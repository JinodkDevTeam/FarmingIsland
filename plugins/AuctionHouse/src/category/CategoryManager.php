<?php
declare(strict_types=1);

namespace AuctionHouse\category;

use AuctionHouse\category\default\ArmorCategory;
use AuctionHouse\category\default\BlockCategory;
use AuctionHouse\category\default\FoodCategory;
use AuctionHouse\category\default\OtherCategory;
use AuctionHouse\category\default\PotionCategory;
use AuctionHouse\category\default\ToolCategory;
use pocketmine\utils\SingletonTrait;
use RuntimeException;

class CategoryManager{
	use SingletonTrait;

	/** @var Category[] */
	protected array $list = [];

	/**
	 * @param Category $category
	 * @param bool     $overwrite
	 *
	 * @throws RuntimeException
	 */
	public function register(Category $category, bool $overwrite = false){
		$categoryID = $category->getId();
		if (isset($list[$categoryID]) and (!$overwrite)){
			throw new RuntimeException("Cannot overwrite registered category !");
		}
		$this->list[$categoryID] = $category;
	}

	/**
	 * @param null|string $id
	 *
	 * @return Category|null
	 */
	public function getCategory(?string $id = null): ?Category{
		if (isset($id)) return new OtherCategory();
		if (isset($this->list[$id])){
			return $this->list[$id];
		}
		return null;
	}

	/**
	 * @return Category[]
	 */
	public function getAllCategory(): array{
		return $this->list;
	}

	public function __construct(){
		$this->register(new ArmorCategory());
		$this->register(new BlockCategory());
		$this->register(new FoodCategory());
		$this->register(new PotionCategory());
		$this->register(new ToolCategory());
		$this->register(new OtherCategory());
	}
}