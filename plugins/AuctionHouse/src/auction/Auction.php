<?php
declare(strict_types=1);

namespace AuctionHouse\auction;

use AuctionHouse\category\Category;
use AuctionHouse\category\CategoryManager;
use JinodkDevTeam\utils\ItemUtils;
use pocketmine\item\Item;

class Auction{

	protected int $id = 0;
	protected string $player = "";
	protected string $item = "";
	protected string $category = "";
	protected float $price = 0;
	protected int $time = 0;
	protected int $auctiontime = 0;
	protected bool $expired = false;
	protected bool $ended = false;

	public function __construct(int $id = 0, string $player = "", string $item = "", string $category = "", float $price = 0, int $time = 0, int $auctiontime = 0, bool $expired = false, bool $ended = false){
		$this->id = $id;
		$this->player = $player;
		$this->item = $item;
		$this->category = $category;
		$this->price = $price;
		$this->time = $time;
		$this->auctiontime = $auctiontime;
		$this->expired = $expired;
		$this->ended = $ended;
	}

	public function getId(): int{
		return $this->id;
	}

	public function getItemCode(): string{
		return $this->item;
	}

	public function getItem(): Item{
		return ItemUtils::fromString($this->getItemCode());
	}

	public function getCategoryID(): string{
		return $this->category;
	}

	public function getCategory(): Category{
		return CategoryManager::getInstance()->getCategory($this->getCategoryID());
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

	public function getAuctionTime(): int{
		return $this->auctiontime;
	}

	public function isExpired(): bool{
		return $this->expired;
	}

	public function isEnded(): bool{
		return $this->ended;
	}

	public static function fromData(array $data): Auction{
		return new Auction(
			(int)$data["Id"],
			(string)$data["Player"],
			(string)$data["Item"],
			(string)$data["Category"],
			(float)$data["Price"],
			(int)$data["Time"],
			(int)$data["AuctionTime"],
			(bool)$data["Expired"],
			(bool)$data["Ended"]
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