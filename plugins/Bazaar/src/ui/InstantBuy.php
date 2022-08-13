<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class InstantBuy extends BaseUI{

	private string $itemid;

	public function __construct(Player $player, string $itemid = ""){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP SELL ORDER...
			$data = yield from $this->getBazaar()->getProvider()->selectSellItem($this->itemid, true);
			if (empty($data)){
				$player->sendMessage("Sorry, noone sell this item !");
				return;
			}
			$form = new CustomForm(function(Player $player, ?array $pos){
				if(!isset($pos[1])) return;
				$amount = $pos[1];
				if(is_int($amount)){
					$player->sendMessage("Amount must be a integer number !");
					return;
				}
				if((int) $amount <= 0){
					$player->sendMessage("Amount must be > 0 !");
					return;
				}
				if($amount > 71680){
					$player->sendMessage("Amount must be <= 71680 items");
					return;
				}
				//Recheck data
				Await::f2c(function() use ($player, $amount) {
					$data = yield from $this->getBazaar()->getProvider()->selectSellItem($this->itemid, true);
					if (empty($data)){
						$player->sendMessage("Sorry, noone sell this item !");
						return;
					}
					$this->confirm($player, (int) $amount, $data);
				});
			});

			$form->setTitle("Instant buy");
			$form->addLabel("Item: " . ItemUtils::toName($this->itemid));
			$form->addInput("Amount:", "123456789");
			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, array $data) : void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::SELL);
			$item_left = $order->getAmount() - $order->getFilled();
			if($count <= $item_left){
				$total += $count * $order->getPrice();
				$count = 0;
				break;
			}else{
				$count -= $item_left;
				$total += $item_left * $order->getPrice();
			}
		}
		if($count > 0){
			$player->sendMessage("Sorry, the bazaar doesnt have enough item for you :< They need " . $count . " items !");
			return;
		}

		$form = new ModalForm(function(Player $player, $value) use ($amount, $total, $data){
			if(!isset($value)) return;
			if(!$value) return;
			if(EconomyAPI::getInstance()->myMoney($player) < $total){
				$player->sendMessage("You dont have enough money to do it !");
				return;
			}
			$this->instantBuy($player, $amount, $data);
		});
		$form->setTitle("Confirm");
		$form->setContent("Instant buy: \nItem: " . ItemUtils::toName($this->itemid) . "\nAmount: " . $amount . "\nYou pay: " . $total . " coins");
		$form->setButton1("YES");
		$form->setButton2("NO");

		$player->sendForm($form);
	}

	public function instantBuy(Player $player, int $amount, array $data) : void{
		Await::f2c(function() use ($player, $amount, $data){
			$total = 0;
			$count = $amount;
			foreach($data as $arrayOrder){
				$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::SELL);
				$item_left = $order->getAmount() - $order->getFilled();
				if($count <= $item_left){
					$order->setFilled($order->getFilled() + $count);
					$total += $count * $order->getPrice();
					if($count == $item_left){
						$order->setFilledStatus(true);
					}
					yield $this->getBazaar()->getProvider()->updateSellFilled($order);
					break;
				}else{
					$count -= $item_left;
					$total += $item_left * $order->getPrice();
					$order->setFilled($order->getFilled() + $item_left);
					$order->setFilledStatus(true);
					yield $this->getBazaar()->getProvider()->updateSellFilled($order);
				}
			}
			$item = ItemUtils::toItem($this->itemid);
			$item->setCount($amount);
			if(!$player->getInventory()->canAddItem($item)){
				$player->sendMessage("Your inventory not enough to get this items, make sure you have enough space !");
				return;
			}
			EconomyAPI::getInstance()->reduceMoney($player, $total);
			$player->getInventory()->addItem($item);
			$player->sendMessage("You have bought x" . $amount . " " . ItemUtils::toName($this->itemid) . " for " . $total . " coins.");
		});
	}
}