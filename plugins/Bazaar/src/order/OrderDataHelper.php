<?php
declare(strict_types=1);

namespace Bazaar\order;

class OrderDataHelper{

	public const BUY = 0;
	public const SELL = 1;

	public static function formData(array $data, int $mode) : SellOrder|BuyOrder{
		if ($mode == self::BUY){
			return new BuyOrder(
				(int)$data["Id"],
				(string)$data["Player"],
				(int)$data["ItemID"],
				(int)$data["Amount"],
				(int)$data["Filled"],
				(float)$data["Price"],
				(int)$data["Time"]
			);
		}
		return new SellOrder(
			(int)$data["Id"],
			(string)$data["Player"],
			(int)$data["ItemID"],
			(int)$data["Amount"],
			(int)$data["Filled"],
			(float)$data["Price"],
			(int)$data["Time"]
		);

	}
}