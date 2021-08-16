<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\data\AvailableItemsIds;
use Bazaar\order\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use Bazaar\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ShopUI extends BaseUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$form = new SimpleForm(function(Player $player, ?int $data){
				if (!isset($data)) return;
				new ItemUI($player, AvailableItemsIds::Ids[$data]);
			});
			foreach(AvailableItemsIds::Ids as $id){
				$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $id]);
				if (empty($data)){
					$buy = 0;
				} else {
					$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
					$buy = $order->getPrice();
				}

				$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => $id]);
				if (empty($data)){
					$sell = 0;
				} else {
					$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
					$sell = $order->getPrice();
				}

				$form->addButton(ItemUtils::toName($id) . "\n" . "Buy: " . $buy . " Sell: " . $sell);
			}
			$form->setTitle("BazaarUI");
			$player->sendForm($form);
		});
	}
}