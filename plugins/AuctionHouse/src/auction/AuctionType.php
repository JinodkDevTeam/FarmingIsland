<?php
declare(strict_types=1);

namespace AuctionHouse\auction;

use pocketmine\utils\EnumTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static AuctionType AUCTION()
 * @method static AuctionType BIN()
 */
final class AuctionType{
	use EnumTrait{
		__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new self(0,"auction"),
			new self(1,"bin"),
		);
	}

	public static function fromId(int $auctiontype_id): ?AuctionType{
		return match ($auctiontype_id) {
			0 => AuctionType::AUCTION(),
			1 => AuctionType::BIN(),
			default => null,
		};
	}
	
	protected int $auctiontype_id;

	public function __construct(int $auctiontype_id, string $enumName){
		$this->auctiontype_id = $auctiontype_id;
		$this->Enum___construct($enumName);
	}

	public function getAuctionTypeId(): int{
		return $this->auctiontype_id;
	}
}