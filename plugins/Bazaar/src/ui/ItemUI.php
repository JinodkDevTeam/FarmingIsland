<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\order\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ItemUI extends BaseUI{

	private int $itemid;

	public function __construct(Player $player, int $itemid){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $this->itemid]);
			if (empty($data)){
				$i_buy_price = 0;
			} else {
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
				$i_buy_price = $order->getPrice();
			}

			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => $this->itemid]);
			if (empty($data)){
				$i_sell_price = 0;
			} else {
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
				$i_sell_price = $order->getPrice();
			}

			$form = new SimpleForm(function(Player $player, ?int $data){
				//TODO: Implement Buy And Sell
			});
			$form->setTitle("ItemUI");
			$form->addButton("Instance buy" . "\n" . "Price: " . $i_buy_price);
			$form->addButton("Instance sell" . "\n" . "Price: " . $i_sell_price);
			$form->addButton("Create buy order");
			$form->addButton("Create sell order");

			$player->sendForm($form);
		});
	}
}