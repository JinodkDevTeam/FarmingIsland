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

	public function __construct(int $id, string $player, int $itemID, int $amount, int $filled, float $price, int $time){
		$this->id = $id;
		$this->player = $player;
		$this->itemID = $itemID;
		$this->amount = $amount;
		$this->filled = $filled;
		$this->price = $price;
		$this->time = $time;
	}

	public function getAmount(): int{
		return $this->amount;
	}

	public function getFilled() : int{
		return $this->filled;
	}

	public function getId(): int{
		return $this->id;
	}

	public function getItemID(): int{
		return $this->itemID;
	}

	public function getPlayer(): string{
		return $this->player;
	}

	public function getPrice() : float{
		return $this->price;
	}

	public function getTime() : int{
		return $this->time;
	}

	public function setAmount(int $amount) : void{
		$this->amount = $amount;
	}

	public function setFilled(int $filled) : void{
		$this->filled = $filled;
	}

	public function setPrice(float $price) : void{
		$this->price = $price;
	}

	public function setTime(int $time) : void{
		$this->time = $time;
	}

	public function setId(int $id) : void{
		$this->id = $id;
	}

	public function setItemID(int $itemID) : void{
		$this->itemID = $itemID;
	}
}
