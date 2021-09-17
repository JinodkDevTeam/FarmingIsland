<?php
declare(strict_types=1);

namespace Bazaar\utils;

use Bazaar\order\BuyOrder;
use Bazaar\order\SellOrder;

class OrderDataHelper{

	public const BUY = 0;
	public const SELL = 1;

	/**
	 * @param array $data
	 * @param int   $mode
	 *
	 * @return SellOrder|BuyOrder
	 * @description Convert from Array Data to Order format
	 */
	public static function formData(array $data, int $mode) : SellOrder|BuyOrder{
		if($mode == self::BUY){
			return new BuyOrder(
				(int) $data["Id"],
				(string) $data["Player"],
				(int) $data["ItemID"],
				(int) $data["Amount"],
				(int) $data["Filled"],
				(float) $data["Price"],
				(int) $data["Time"],
				(bool) $data["IsFilled"]
			);
		}
		return new SellOrder(
			(int) $data["Id"],
			(string) $data["Player"],
			(int) $data["ItemID"],
			(int) $data["Amount"],
			(int) $data["Filled"],
			(float) $data["Price"],
			(int) $data["Time"],
			(bool) $data["IsFilled"]
		);
	}

	/**
	 * @param array $data
	 * @param int   $mode
	 *
	 * @return SellOrder|BuyOrder
	 * @description Covert SQL Query data to Order Format
	 */
	public static function fromSqlQueryData(array $data, int $mode) : SellOrder|BuyOrder{
		if($mode == self::BUY){
			return new BuyOrder(
				-1,
				(string) $data["player"],
				(int) $data["itemID"],
				(int) $data["amount"],
				(int) $data["filled"],
				(float) $data["price"],
				(int) $data["time"],
				(bool) $data["isfilled"]
			);
		}
		return new SellOrder(
			-1,
			(string) $data["player"],
			(int) $data["itemID"],
			(int) $data["amount"],
			(int) $data["filled"],
			(float) $data["price"],
			(int) $data["time"],
			(bool) $data["isfilled"]
		);
	}

	/**
	 * @param BuyOrder|SellOrder $order
	 *
	 * @return array
	 * @description Convert Order format to array data
	 */
	public static function toData(BuyOrder|SellOrder $order) : array{
		return [
			"Id" => $order->getId(),
			"Player" => $order->getPlayer(),
			"ItemID" => $order->getItemID(),
			"Amount" => $order->getAmount(),
			"Filled" => $order->getFilled(),
			"Price" => $order->getPrice(),
			"Time" => $order->getTime(),
			"IsFilled" => $order->isFilled()
		];
	}

	/**
	 * @param BuyOrder|SellOrder $order
	 *
	 * @return array
	 * @description Convert Order format to SQL Query data
	 */
	public static function toSqlQueryData(BuyOrder|SellOrder $order) : array{
		return [
			"id" => $order->getId(),
			"player" => $order->getPlayer(),
			"itemID" => $order->getItemID(),
			"amount" => $order->getAmount(),
			"filled" => $order->getFilled(),
			"price" => $order->getPrice(),
			"time" => $order->getTime(),
			"isfilled" => $order->isFilled()
		];
	}
}