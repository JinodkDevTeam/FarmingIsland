<?php
declare(strict_types=1);

namespace AuctionHouse\auction;

use AuctionHouse\category\Category;
use AuctionHouse\category\CategoryManager;
use JinodkDevTeam\utils\ItemUtils;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

class Auction{

	protected int $id = 0;
	protected string $player = "";
	protected string $item = "";
	protected string $category = "";
	protected float $price = 0;
	protected int $time = 0;
	protected int $auctiontime = 0;
	protected bool $expired = false;
	protected bool $havebid = false;

	public function __construct(int $id = 0, string $player = "", string $item = "", string $category = "", float $price = 0, int $time = 0, int $auctiontime = 0, bool $expired = false, bool $havebid = false){
		$this->id = $id;
		$this->player = $player;
		$this->item = $item;
		$this->category = $category;
		$this->price = $price;
		$this->time = $time;
		$this->auctiontime = $auctiontime;
		$this->expired = $expired;
		$this->havebid = $havebid;
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

	/**
	 * @return int
	 * @description Return Auction Time (Hours)
	 */
	public function getAuctionTime(): int{
		return $this->auctiontime;
	}

	/**
	 * @return int
	 * @description Return time left for a auction (seconds)
	 */
	public function getTimeLeft(): int{
		return $this->getTime() + $this->getAuctionTime()*3600 - time();
	}

	/**
	 * @return bool
	 * @description Return true if this auction is expired.
	 */
	public function isExpired(): bool{
		if ($this->getTimeLeft() > 0){
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 * @description Return true If This Auction is Expired in Data (not 100% correct)
	 */
	public function isExpiredInData(): bool{
		return $this->expired;
	}

	public function isHaveBid(): bool{
		return $this->havebid;
	}

	public function isSeller(Player|string $player): bool{
		if ($player instanceof Player) $player = $player->getName();
		if ($this->getPlayer() === $player){
			return true;
		}
		return false;
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
			(bool)$data["HaveBid"]
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

	public static function getTestAuction(): Auction{
		return new Auction(
			0,
			"Steve",
			ItemUtils::toString(VanillaItems::PAPER()->setCustomName("Just a test auction")),
			"",
			1000,
			time(),
			2,
			false,
			false
		);
	}
}