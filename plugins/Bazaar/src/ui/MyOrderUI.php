<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use FILang\FILang;
use FILang\TranslationFactory;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class MyOrderUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$buy_data = yield from $this->getBazaar()->getProvider()->selectBuy($player);
			$sell_data = yield from $this->getBazaar()->getProvider()->selectSell($player);

			$form = new SimpleForm(function(Player $player, ?int $data) use ($buy_data, $sell_data){
				if(!isset($data)) return;
				if($data > (count($buy_data) - 1)){
					new SellOrderManagerUI($player, (int) $sell_data[$data - count($buy_data)]["Id"]);
					return;
				}
				new BuyOrderManagerUI($player, $buy_data[$data]["Id"]);
			});
			$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_title()));
			foreach($buy_data as $data){
				$order = OrderDataHelper::formData($data, OrderDataHelper::BUY);
				$filled = round(($order->getFilled() / $order->getAmount()) * 100, 2);
				$form->addButton(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_button_order_buy(ItemUtils::toName($order->getItemID()), (string)$filled)));
			}
			foreach($sell_data as $data){
				$order = OrderDataHelper::formData($data, OrderDataHelper::BUY);
				$filled = round(($order->getFilled() / $order->getAmount()) * 100, 2);
				$form->addButton(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_button_order_sell(ItemUtils::toName($order->getItemID()), (string)$filled)));
			}

			$player->sendForm($form);
		});
	}
}