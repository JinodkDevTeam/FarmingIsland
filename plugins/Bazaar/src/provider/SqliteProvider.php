<?php
declare(strict_types=1);

namespace Bazaar\provider;

use Bazaar\Bazaar;
use Bazaar\order\BuyOrder;
use Bazaar\order\SellOrder;
use Generator;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;
use poggit\libasynql\SqlError;

class SqliteProvider implements Provider{

	protected const INIT_BUY = "bazaar.init.buy";
	protected const INIT_SELL = "bazaar.init.sell";
	protected const REGISTER_BUY = "bazaar.register.buy";
	protected const REGISTER_SELL = "bazaar.register.sell";
	protected const REMOVE_BUY = "bazaar.remove.buy";
	protected const REMOVE_SELL = "bazaar.remove.sell";
	protected const SELECT_BUY_ID = "bazaar.select.buy.id";
	protected const SELECT_BUY_PLAYER = "bazaar.select.buy.player";
	protected const SELECT_BUY_ITEMID_UNSORT = "bazaar.select.buy.itemid.unsort";
	protected const SELECT_BUY_ITEMID_SORT_PRICE = "bazaar.select.buy.itemid.sort.price";
	protected const SELECT_SELL_ID = "bazaar.select.sell.id";
	protected const SELECT_SELL_PLAYER = "bazaar.select.sell.player";
	protected const SELECT_SELL_ITEMID_UNSORT = "bazaar.select.sell.itemid.unsort";
	protected const SELECT_SELL_ITEMID_SORT_PRICE = "bazaar.select.sell.itemid.sort.price";
	protected const UPDATE_BUY_FILLED = "bazaar.update.buy.filled";
	protected const UPDATE_SELL_FILLED = "bazaar.update.sell.filled";
	protected const UPDATE_BUY_ISFILLED = "bazaar.update.buy.isfilled";
	protected const UPDATE_SELL_ISFILLED = "bazaar.update.sell.isfilled";


	/** @var Bazaar */
	private Bazaar $bazaar;
	/** @var DataConnector */
	private DataConnector $database;

	/**
	 * SqliteProvider constructor.
	 *
	 * @param Bazaar $bazaar
	 */
	public function __construct(Bazaar $bazaar){
		$this->bazaar = $bazaar;
	}

	/**
	 * @description Load everything...
	 */
	public function init() : void{
		try{
			$this->database = libasynql::create($this->getBazaar(), $this->getBazaar()->getConfig()->get("database"), [
				"sqlite" => "sqlite.sql"
			]);

			$this->database->executeGeneric(self::INIT_BUY);
			$this->database->executeGeneric(self::INIT_SELL);
		} catch(SqlError $error){
			$this->getBazaar()->getLogger()->error($error->getMessage());
		}finally{
			$this->database->waitAll();
		}
	}

	/**
	 * @return Bazaar
	 */
	private function getBazaar() : Bazaar{
		return $this->bazaar;
	}

	public function close() : void{
		if(isset($this->database)) $this->database->close();
	}

	public function registerBuy(BuyOrder $order) : Generator{
		$args = [
			"player" => $order->getPlayer(),
			"price" => $order->getPrice(),
			"amount" => $order->getAmount(),
			"filled" => $order->getFilled(),
			"itemID" => $order->getItemID(),
			"time" => $order->getTime(),
			"isfilled" => $order->isFilled()
		];
		yield $this->database->asyncInsert(self::REGISTER_BUY, $args);
	}

	public function registerSell(SellOrder $order) : Generator{
		$args = [
			"player" => $order->getPlayer(),
			"price" => $order->getPrice(),
			"amount" => $order->getAmount(),
			"filled" => $order->getFilled(),
			"itemID" => $order->getItemID(),
			"time" => $order->getTime(),
			"isfilled" => $order->isFilled()
		];
		yield $this->database->asyncInsert(self::REGISTER_SELL, $args);
	}

	public function rawRemoveBuy(int $id) : Generator{
		yield $this->database->asyncChange(self::REMOVE_BUY, [["id" => $id]]);
	}

	public function rawRemoveSell(int $id) : Generator{
		yield $this->database->asyncChange(self::REMOVE_SELL, [["id" => $id]]);
	}

	public function removeBuy(BuyOrder $order) : Generator{
		yield $this->rawRemoveBuy($order->getId());
	}

	public function removeSell(SellOrder $order) : Generator{
		yield $this->rawRemoveSell($order->getId());
	}

	public function selectBuy(int|Player $id) : Generator{
		if ($id instanceof Player){
			return yield from $this->database->asyncSelect(self::SELECT_BUY_PLAYER, [
				"player" => $id->getName()
			]);
		}
		return yield from $this->database->asyncSelect(self::SELECT_BUY_ID, [
			"id" => $id
		]);
	}

	public function selectBuyItem(string $itemid, bool $sort_price = false) : Generator{
		if ($sort_price){
			return yield from $this->database->asyncSelect(self::SELECT_BUY_ITEMID_SORT_PRICE, [
				"itemid" => $itemid
			]);
		} else {
			return yield from $this->database->asyncSelect(self::SELECT_BUY_ITEMID_UNSORT, [
				"itemid" => $itemid
			]);
		}
	}

	public function selectSell(int|Player $id) : Generator{
		if ($id instanceof Player){
			return yield from $this->database->asyncSelect(self::SELECT_SELL_PLAYER, [
				"player" => $id->getName()
			]);
		}
		return yield from $this->database->asyncSelect(self::SELECT_SELL_ID, [
			"id" => $id
		]);
	}

	public function selectSellItem(string $itemid, bool $sort_price = false) : Generator{
		if ($sort_price){
			return yield from $this->database->asyncSelect(self::SELECT_SELL_ITEMID_SORT_PRICE, [
				"itemid" => $itemid
			]);
		} else {
			return yield from $this->database->asyncSelect(self::SELECT_SELL_ITEMID_UNSORT, [
				"itemid" => $itemid
			]);
		}
	}

	public function rawUpdateBuyFilled(int $id, int $filled) : Generator{
		yield $this->database->asyncChange(self::UPDATE_BUY_FILLED, [
			"id" => $id,
			"filled" => $filled
		]);
	}

	public function rawUpdateBuyIsFilled(int $id, bool $isfilled) : Generator{
		yield $this->database->asyncChange(self::UPDATE_BUY_ISFILLED, [
			"id" => $id,
			"isfilled" => $isfilled
		]);
	}

	public function rawUpdateSellFilled(int $id, int $filled) : Generator{
		yield $this->database->asyncChange(self::UPDATE_SELL_FILLED, [
			"id" => $id,
			"filled" => $filled
		]);
	}

	public function rawUpdateSellIsFilled(int $id, bool $isfilled) : Generator{
		yield $this->database->asyncChange(self::UPDATE_SELL_ISFILLED, [
			"id" => $id,
			"isfilled" => $isfilled
		]);
	}

	public function updateBuyFilled(BuyOrder $order) : Generator{
		yield $this->rawUpdateBuyFilled($order->getId(), $order->getFilled());
		yield $this->rawUpdateBuyIsFilled($order->getId(), $order->isFilled());
	}

	public function updateSellFilled(SellOrder $order) : Generator{
		yield $this->rawUpdateSellFilled($order->getId(), $order->getFilled());
		yield $this->rawUpdateSellIsFilled($order->getId(), $order->isFilled());
	}
}