<?php
declare(strict_types=1);

namespace ShopUI;

class Category{

	protected string $name;
	protected string $icon;
	/** @var Category[]|ShopItem[] */
	protected array $list;
	protected Category|null $parent = null;

	/**
	 * @param string                $name
	 * @param string                $icon
	 * @param Category[]|ShopItem[] $list
	 * @param Category|null         $parent
	 */
	public function __construct(string $name, string $icon, array $list, Category $parent = null){
		$this->name = $name;
		$this->icon = $icon;
		$this->list = $list;
		$this->parent = $parent;
	}

	public function getName(): string{
		return $this->name;
	}

	public function getIconLink(): string{
		return $this->icon;
	}

	public function getList(): array{
		return $this->list;
	}
}