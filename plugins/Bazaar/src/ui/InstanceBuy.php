<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\provider\SqliteProvider;
use Bazaar\utils\ItemUtils;
use Bazaar\utils\OrderDataHelper;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class InstanceBuy extends BaseUI{

	private int $itemid;

	public function __construct(Player $player, int $itemid = 0){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP SELL ORDER...
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => $this->itemid]);
			$form = new CustomForm(function(Player $player, ?array $pos) use ($data){
				if (!isset($pos[1])) return;
				$amount = $pos[1];
				if (is_int($amount)){
					$player->sendMessage("Amount must be a integer number !");
					return;
				}
				if ((int)$amount <= 0){
					$player->sendMessage("Amount must be > 0 !");
					return;
				}
				if ($amount > 71680){
					$player->sendMessage("Amount must be <= 71680 items");
					return;
				}
				$this->confirm($player, (int)$amount, $data);
			});

			$form->setTitle("Instance buy");
			$form->addLabel("Item: " . ItemUtils::toName($this->itemid));
			$form->addInput("Amount:", "123456789");
			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, array $data): void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::SELL);
			$item_left = $order->getAmount() - $order->getFilled();
			if ($count <= $item_left){
				$total += $count * $order->getPrice();
				$count = 0;
				break;
			} else {
				$count -= $item_left;
				$total += $item_left * $order->getPrice();
			}
		}
		if ($count > 0){
			$player->sendMessage("Sorry, the bazaar doesnt have enough item for you :< They need " . $count . " items !");
			return;
		}

		$form = new ModalForm(function(Player $player, $value) use ($amount, $total, $data){
			if (!isset($value)) return;
			if ($value == false) return;
			if (EconomyAPI::getInstance()->myMoney($player) < $total){
				$player->sendMessage("You dont have enough money to do it !");
				return;
			}
			$this->instanceBuy($player, $amount, $data);
		});
		$form->setTitle("Confirm");
		$form->setContent("Instance buy: \nItem: " . ItemUtils::toName($this->itemid) . "\nAmount: " . $amount . "\nYou pay: " . $total . " coins");
		$form->setButton1("YES");
		$form->setButton2("NO");

		$player->sendForm($form);
	}

	public function instanceBuy(Player $player, int $amount, array $data): void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::SELL);
			$item_left = $order->getAmount() - $order->getFilled();
			if ($count <= $item_left){
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::UPDATE_SELL_FILLED, [
					"id" => $order->getId(),
					"filled" => $order->getFilled() + $count
				]);
				$total += $count * $order->getPrice();
				break;
			} else {
				$count -= $item_left;
				$total += $item_left * $order->getPrice();
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::UPDATE_SELL_FILLED, [
					"id" => $order->getId(),
					"filled" => $order->getFilled() + $item_left
				]);
				//TODO: Update ISFILLED = TRUE
			}
		}
		$item = ItemUtils::toItem($this->itemid);
		$item->setCount($amount);
		if (!$player->getInventory()->canAddItem($item)){
			$player->sendMessage("Your inventory not enough to get this items, make sure you have enough space !");
			return;
		}
		EconomyAPI::getInstance()->reduceMoney($player, $total);
		$player->getInventory()->addItem($item);
		$player->sendMessage("You have bought x" . $amount . " " . ItemUtils::toName($this->itemid) . " for " . $total . " coins.");
	}
}