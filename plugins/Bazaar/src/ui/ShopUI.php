<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\data\AvailableItemsIds;
use Bazaar\provider\SqliteProvider;
use Bazaar\utils\OrderDataHelper;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ShopUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$form = new SimpleForm(function(Player $player, ?int $data){
				if(!isset($data)) return;
				if($data == 0){
					new MyOrderUI($player);
					return;
				}
				new ItemUI($player, AvailableItemsIds::Ids[$data - 1]);
			});

			$form->addButton("My orders");
			foreach(AvailableItemsIds::Ids as $id){
				$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $id]);
				if(empty($data)){
					$buy = 0;
				}else{
					$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
					$buy = $order->getPrice();
				}
				$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => $id]);
				if(empty($data)){
					$sell = 0;
				}else{
					$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
					$sell = $order->getPrice();
				}

				$form->addButton(ItemUtils::toName($id) . "\n" . "Buy: " . $sell . " Sell: " . $buy);
			}
			$form->setTitle("Bazaar Shop");
			$player->sendForm($form);
		});
	}
}