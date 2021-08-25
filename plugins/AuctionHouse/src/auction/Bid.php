<?php
declare(strict_types=1);

namespace AuctionHouse\auction;

class Bid{

	protected string $player = "";
	protected int $id = 0;
	protected float $price = 0;

	public function __construct(string $player = "", int $id = 0, float $price = 0){
		$this->player = $player;
		$this->id = $id;
		$this->price = $price;
	}

	public function getPlayer(): string{
		return $this->player;
	}

	public function getAuctionId(): int{
		return $this->id;
	}

	public function getBidPrice(): float{
		return $this->price;
	}

	public static function fromData(array $data): Bid{
		return new Bid(
			(string)$data["Player"],
			(int)$data["Id"],
			(float)$data["Price"]
		);
	}

	/**
	 * @param array $array
	 *
	 * @return Bid[]
	 */
	public static function fromArray(array $array): array{
		$bids = [];
		foreach($array as $data){
			array_push($bids, self::fromData($data));
		}
		return $bids;
	}
}