<?php
declare(strict_types=1);

namespace Bazaar\order;

abstract class BaseOrder{

	protected int $id;
	protected string $player;
	protected int $itemID;
	protected int $amount;
	protected int $filled;
	protected float $price;
	protected int $time;
	protected bool $isfilled;

	public function __construct(int $id, string $player, int $itemID = 0, int $amount = 0, int $filled = 0, float $price = 0, int $time = 0, bool $isfilled = false){
		$this->id = $id;
		$this->player = $player;
		$this->itemID = $itemID;
		$this->amount = $amount;
		$this->filled = $filled;
		$this->price = $price;
		$this->time = $time;
		$this->isfilled = $isfilled;
	}

	/**
	 * @return bool
	 */
	public function isFilled() : bool{
		return $this->isfilled;
	}

	public function getAmount() : int{
		return $this->amount;
	}

	public function setAmount(int $amount) : void{
		$this->amount = $amount;
	}

	public function getFilled() : int{
		return $this->filled;
	}

	public function setFilled(int $filled) : void{
		$this->filled = $filled;
	}

	public function getId() : int{
		return $this->id;
	}

	public function setId(int $id) : void{
		$this->id = $id;
	}

	public function getItemID() : int{
		return $this->itemID;
	}

	public function setItemID(int $itemID) : void{
		$this->itemID = $itemID;
	}

	public function getPlayer() : string{
		return $this->player;
	}

	public function getPrice() : float{
		return $this->price;
	}

	public function setPrice(float $price) : void{
		$this->price = $price;
	}

	public function getTime() : int{
		return $this->time;
	}

	public function setTime(int $time) : void{
		$this->time = $time;
	}

	public function setFilledStatus(bool $status) : void{
		$this->isfilled = $status;
	}
}
