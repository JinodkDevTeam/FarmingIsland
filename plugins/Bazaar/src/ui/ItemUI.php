<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ItemUI extends BaseUI{

	private string $itemid;

	public function __construct(Player $player, string $itemid){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->getBazaar()->getProvider()->selectBuyItem($this->itemid, true);
			if(empty($data)){
				$top_buy_price = "N/A";
			}else{
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
				$top_buy_price = $order->getPrice();
			}

			$data = yield from $this->getBazaar()->getProvider()->selectSellItem($this->itemid, true);
			if(empty($data)){
				$top_sell_price = "N/A";
			}else{
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
				$top_sell_price = $order->getPrice();
			}

			$form = new SimpleForm(function(Player $player, ?int $data){
				if(!isset($data)) return;
				switch($data){
					case 0:
						new InstantBuy($player, $this->itemid);
						break;
					case 1:
						new InstantSell($player, $this->itemid);
						break;
					case 2:
						new BuyOrderUI($player, $this->itemid);
						break;
					case 3:
						new SellOrderUI($player, $this->itemid);
						break;
					case 4:
						new ListOrderUI($player, $this->itemid, ListOrderUI::BUY);
						break;
					case 5:
						new ListOrderUI($player, $this->itemid, ListOrderUI::SELL);
						break;
				}
			});
			$form->setTitle(ItemUtils::toName($this->itemid));
			$form->setContent("Item: " . ItemUtils::toName($this->itemid));
			$form->addButton("Instant buy" . "\n" . "Price: " . $top_sell_price);
			$form->addButton("Instant sell" . "\n" . "Price: " . $top_buy_price);
			$form->addButton("Create buy order");
			$form->addButton("Create sell order");
			$form->addButton("List buy order");
			$form->addButton("List sell order");

			$player->sendForm($form);
		});
	}
}