<?php

declare(strict_types=1);

namespace FishingModule\event;

use FishingModule\entity\FishingHook;
use FishingModule\Loader;
use pocketmine\entity\Human;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\item\Item;
use pocketmine\plugin\Plugin;

class EntityFishEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	public const STATE_FISHING = 0;
	public const STATE_CAUGHT_FISH = 1;
	public const STATE_CAUGHT_ENTITY = 2;
	public const STATE_CAUGHT_NOTHING = 3;

	public const TYPE_NONE = 0;
	public const TYPE_WATER = 1;
	public const TYPE_LAVA = 2;

	protected Human $entity;
	protected FishingHook $fishingHook;
	protected int $state;
	protected int $xpDropAmount;
	/** @var Item[] */
	protected array $itemsResult;
	protected int $liquidType;

	/**
	 * PlayerFishEvent constructor.
	 *
	 * @param Human       $entity
	 * @param FishingHook $fishingHook
	 * @param int         $state
	 * @param int         $xpDropAmount
	 * @param Item[]      $itemsResult
	 */
	public function __construct(Human $entity, FishingHook $fishingHook, int $state, int $liquidType = self::TYPE_NONE, int $xpDropAmount = 0, array $itemsResult = []){
		parent::__construct(Loader::getInstance());
		$this->entity = $entity;
		$this->fishingHook = $fishingHook;
		$this->state = $state;
		$this->xpDropAmount = $xpDropAmount;
		$this->itemsResult = $itemsResult;
		$this->liquidType = $liquidType;
	}

	/**
	 * @return Human
	 */
	public function getEntity() : Human{
		return $this->entity;
	}

	/**
	 * @return FishingHook
	 */
	public function getFishingHook() : FishingHook{
		return $this->fishingHook;
	}

	/**
	 * @return int
	 */
	public function getState() : int{
		return $this->state;
	}

	/**
	 * @return int
	 */
	public function getXpDropAmount() : int{
		return $this->xpDropAmount;
	}

	/**
	 * @param int $amount
	 */
	public function setXpDropAmount(int $amount) : void{
		$this->xpDropAmount = $amount;
	}

	/**
	 * @return Item[]|null
	 */
	public function getItemsResult() : ?array{
		return $this->itemsResult;
	}

	/**
	 * @param Item[] $itemsResult
	 */
	public function setItemResult(array $itemsResult) : void{
		$this->itemsResult = $itemsResult;
	}

	/**
	 * @return int
	 */
	public function getLiquidType() : int{
		return $this->liquidType;
	}

	/**
	 * @return Plugin
	 */
	public function getPlugin() : Plugin{
		return Loader::getInstance();
	}
}