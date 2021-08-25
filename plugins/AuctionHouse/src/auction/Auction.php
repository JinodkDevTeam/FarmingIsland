<?php
declare(strict_types=1);

namespace AuctionHouse\auction;

class Auction{

	protected int $id = 0;
	protected string $player = "";
	protected string $item = "";
	protected float $price = 0;
	protected int $time = 0;
	protected bool $expired = false;

	public function __construct(int $id = 0, string $player = "", string $item = "", float $price = 0, int $time = 0, bool $expired = false){
		$this->id = $id;
		$this->player = $player;
		$this->item = $item;
		$this->price = $price;
		$this->time = $time;
		$this->expired = $expired;
	}

	public function getId(): int{
		return $this->id;
	}

	public function getItem(): string{
		return $this->item;
	}

	public function getPlayer(): string{
		return $this->player;
	}

	public function getPrice(): float{
		return $this->price;
	}

	public function getTime(): int{
		return $this->time;
	}

	public function isExpired(): bool{
		return $this->expired;
	}

	public static function fromData(array $data): Auction{
		return new Auction(
			(int)$data["Id"],
			(string)$data["Player"],
			(string)$data["Item"],
			(float)$data["Price"],
			(int)$data["Time"],
			(bool)$data["Expired"]
		);
	}

	/**
	 * @param array $array
	 *
	 * @return Auction[]
	 */
	public static function fromArray(array $array): array{
		$autions = [];
		foreach($array as $data){
			array_push($autions, self::fromData($data));
		}
		return $autions;
	}
}