<?php
declare(strict_types=1);

namespace AuctionHouse\provider;

use AuctionHouse\auction\Auction;
use AuctionHouse\auction\Bid;
use AuctionHouse\Loader;
use Generator;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use SOFe\AwaitGenerator\Await;

class SqliteProvider{

	protected const INIT_AUCTION = "auction.init.auction";
	protected const INIT_BID = "auction.init.bid";
	protected const REMOVE_AUCTION = "auction.remove.auction";
	protected const REMOVE_BID = "auction.remove.bid";
	protected const REGISTER_AUCTION = "auction.register.auction";
	protected const REGISTER_BID = "auction.register.bid";
	protected const UPDATE_AUCTION_EXPIRED = "auction.update.auction.expired";
	protected const UPDATE_AUCTION_ENDED = "auction.update.auction.ended";
	protected const UPDATE_AUCTION_BID_PRICE = "auction.update.bid.price";
	protected const SELECT_AUCTION_ID = "auction.select.auction.id";
	protected const SELECT_AUCTION_PLAYER = "auction.select.auction.player";
	protected const SELECT_AUCTION_ALL = "auction.select.auction.all";
	protected const SELECT_AUCTION_ALL_NO_EXPIRED = "auction.select.auction.all.no-expired";
	protected const SELECT_AUCTION_ALL_EXPIRED = "auction.select.auction.all.expired";
	protected const SELECT_BID_ID = "auction.select.bid.id";
	protected const SELECT_BID_PLAYER = "autcion.select.bid.player";

	protected DataConnector $db;
	protected Loader $loader;

	public function __construct(Loader $loader){
		$this->loader = $loader;
	}

	protected function getLoader(): Loader{
		return $this->loader;
	}

	public function init(): void{
		$this->db = libasynql::create($this->getLoader(), $this->getLoader()->getConfig()->get("database"), [
			"sqlite" => "sqlite.sql"
		]);
		$this->db->executeGeneric(self::INIT_AUCTION);
		$this->db->executeGeneric(self::INIT_BID);
	}

	public function close(): void{
		if (isset($this->db)) $this->db->close();
	}

	protected function asyncSelect(string $query, array $args) : Generator{
		$this->db->executeSelect($query, $args, yield, yield Await::REJECT);
		return Await::ONCE;
	}

	protected function executeChange(string $query, array $args): void{
		$this->db->executeChange($query, $args);
	}

	public function removeAuction(int $id): void{
		$this->executeChange(self::REMOVE_AUCTION, [
			"id" => $id
		]);
	}

	public function removeBid(int $id): void{
		$this->executeChange(self::REMOVE_BID, [
			"id" => $id
		]);
	}

	public function registerAuction(Auction $aution): void{
		$this->executeChange(self::REGISTER_AUCTION, [
			"player" => $aution->getPlayer(),
			"item" => $aution->getItemCode(),
			"category" => $aution->getCategoryID(),
			"price" => $aution->getPrice(),
			"time" => $aution->getTime(),
			"auctiontime" => $aution->getAuctionTime()
		]);
	}

	public function registerBid(Bid $bid): void{
		$this->executeChange(self::REGISTER_BID, [
			"player" => $bid->getPlayer(),
			"id" => $bid->getAuctionId(),
			"price" => $bid->getBidPrice()
		]);
	}

	public function updateAuctionExpired(Auction $aution): void{
		$this->executeChange(self::UPDATE_AUCTION_EXPIRED, [
			"id" => $aution->getId(),
			"expired" => $aution->isExpired()
		]);
	}

	public function updateAuctionEnded(Auction $auction): void{
		$this->executeChange(self::UPDATE_AUCTION_ENDED, [
			"id" => $auction->getId(),
			"ended" => $auction->isEnded()
		]);
	}

	public function updateBidPrice(Bid $bid): void{
		$this->executeChange(self::UPDATE_AUCTION_BID_PRICE, [
			"player" => $bid->getPlayer(),
			"id" => $bid->getAuctionId(),
			"price" => $bid->getBidPrice()
		]);
	}

	public function selectAuctionID(int $id): Generator{
		return yield $this->asyncSelect(self::SELECT_AUCTION_ID, ["id" => $id]);
	}

	public function selectAuctionAll(string $category): Generator{
		return yield $this->asyncSelect(self::SELECT_AUCTION_ALL, ["category" => $category]);
	}

	public function selectAuctionAllNoExpired(string $category): Generator{
		return yield $this->asyncSelect(self::SELECT_AUCTION_ALL_NO_EXPIRED, ["category" => $category]);
	}

	public function selectAuctionAllExpired(string $category): Generator{
		return yield $this->asyncSelect(self::SELECT_AUCTION_ALL_EXPIRED, ["category" => $category]);
	}

	public function selectAuctionPlayer(string $player): Generator{
		return yield $this->asyncSelect(self::SELECT_AUCTION_PLAYER, ["player" => $player]);
	}

	public function selectBidId(int $id): Generator{
		return yield $this->asyncSelect(self::SELECT_BID_ID, ["id" => $id]);
	}

	public function selectBidPlayer(string $player): Generator{
		return yield $this->asyncSelect(self::SELECT_BID_PLAYER, ["player" => $player]);
	}
}