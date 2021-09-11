<?php
declare(strict_types=1);

namespace Bazaar\event;

use Bazaar\order\BuyOrder;
use Bazaar\order\SellOrder;

class OrderUpdateEvent extends OrderEvent{

	protected BuyOrder|SellOrder $result;

	public function __construct(SellOrder|BuyOrder $order, SellOrder|BuyOrder $result){
		$this->result = $result;
		parent::__construct($order);
	}

	public function getResult() : BuyOrder|SellOrder{
		return $this->result;
	}
}