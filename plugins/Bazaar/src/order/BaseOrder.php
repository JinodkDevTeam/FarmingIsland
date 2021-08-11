<?php
declare(strict_types=1);

namespace Bazaar\order;

use pocketmine\player\Player;

abstract class BaseOrder{

	protected int $id;
	protected Player $player;
	protected int $itemID;
	protected int $amount;
	protected int $price;
	protected int $time;

	public function __construct(int $id, Player $player, int $itemID, int $amount, int $price, int $time){
		$this->id = $id;
		$this->player = $player;
		$this->itemID = $itemID;
		$this->amount = $amount;
		$this->price = $price;
		$this->time = $time;
	}

	/**
	 * @return int
	 */
	public function getAmount() : int{
		return $this->amount;
	}

	/**
	 * @return int
	 */
	public function getId() : int{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getItemID() : int{
		return $this->itemID;
	}

	/**
	 * @return Player
	 */
	public function getPlayer() : Player{
		return $this->player;
	}

	/**
	 * @return int
	 */
	public function getPrice() : int{
		return $this->price;
	}

	/**
	 * @return int
	 */
	public function getTime() : int{
		return $this->time;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount) : void{
		$this->amount = $amount;
	}

	/**
	 * @param int $price
	 */
	public function setPrice(int $price) : void{
		$this->price = $price;
	}

	/**
	 * @param int $time
	 */
	public function setTime(int $time) : void{
		$this->time = $time;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id) : void{
		$this->id = $id;
	}

	/**
	 * @param int $itemID
	 */
	public function setItemID(int $itemID) : void{
		$this->itemID = $itemID;
	}

	/**
	 * @param Player $player
	 */
	public function setPlayer(Player $player) : void{
		$this->player = $player;
	}
}
