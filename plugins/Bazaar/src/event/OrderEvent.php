<?php
declare(strict_types=1);

namespace Bazaar\event;

use Bazaar\Bazaar;
use Bazaar\order\BuyOrder;
use Bazaar\order\SellOrder;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\Server;

class OrderEvent extends PluginEvent implements Cancellable{
	use CancellableTrait;

	protected BuyOrder|SellOrder $order;

	public function __construct(BuyOrder|SellOrder $order){
		$this->order = $order;
		parent::__construct($this->getBazaar());
	}

	public function getOrder(): SellOrder|BuyOrder{
		return $this->order;
	}

	private function getBazaar(): ?Bazaar{
		$bazaar = Server::getInstance()->getPluginManager()->getPlugin("BazaarShop");
		if ($bazaar instanceof Bazaar){
			return $bazaar;
		}
		return null;
	}
}