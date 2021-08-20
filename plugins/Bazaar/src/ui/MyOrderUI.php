<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MyOrderUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){

			$buy_data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_PLAYER, ["player" => $player->getName()]);
			$sell_data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_PLAYER, ["player" => $player->getName()]);

			$form = new SimpleForm(function(Player $player, ?int $data) use ($buy_data, $sell_data){
				if (!isset($data)) return;
				if ($data > (count($buy_data) - 1)){
					new SellOrderManagerUI($player, (int)$sell_data[$data - count($buy_data)]["Id"]);
					return;
				}
				new BuyOrderManagerUI($player, $buy_data[$data]["Id"]);
			});
			$form->setTitle("My Orders");
			foreach($buy_data as $data){
				$order = OrderDataHelper::formData($data, OrderDataHelper::BUY);
				$filled = round(($order->getFilled() / $order->getAmount()) * 100, 2);
				$form->addButton("[BUY] " . ItemUtils::toName($order->getItemID()) . "\nFilled: " . $filled . " percent");
			}
			foreach($sell_data as $data){
				$order = OrderDataHelper::formData($data, OrderDataHelper::BUY);
				$filled = round(($order->getFilled() / $order->getAmount()) * 100, 2);
				$form->addButton("[SELL] " . ItemUtils::toName($order->getItemID()) . "\nFilled: " . $filled . " percent");
			}

			$player->sendForm($form);
		});
	}
}