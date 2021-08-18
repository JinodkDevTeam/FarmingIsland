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

class InstanceSell extends BaseUI{

	private int $itemid;

	public function __construct(Player $player, int $itemid = 0){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP BUY ORDER...
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $this->itemid]);
			$max = ItemUtils::getItemCount($player, ItemUtils::toItem($this->itemid));
			$form = new CustomForm(function(Player $player, ?array $pos) use ($data, $max){
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
				if ($amount > $max){
					$player->sendMessage("You dont have enough item to sell.");
					return;
				}
				$this->confirm($player, (int)$amount, $data);
			});

			$form->setTitle("Instance sell");
			$form->addLabel("Item: " . ItemUtils::toName($this->itemid));
			$form->addInput("Amount:", "Max: " . $max);
			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, array $data): void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::BUY);
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
			$player->sendMessage("Bazaar just want to buy from you " . $amount - $count . " items !");
			return;
		}

		$form = new ModalForm(function(Player $player, $value) use ($amount, $total, $data){
			if (!isset($value)) return;
			if ($value == false) return;
			$this->instanceSell($player, $amount, $data);
		});
		$form->setTitle("Confirm");
		$form->setContent("Instance sell: \nItem: " . ItemUtils::toName($this->itemid) . "\nAmount: " . $amount . "\nYou gain: " . $total . " coins");
		$form->setButton1("YES");
		$form->setButton2("NO");

		$player->sendForm($form);
	}

	public function instanceSell(Player $player, int $amount, array $data): void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::BUY);
			$item_left = $order->getAmount() - $order->getFilled();
			if ($count <= $item_left){
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::UPDATE_BUY_FILLED, [
					"id" => $order->getId(),
					"filled" => $order->getFilled() + $count
				]);
				$total += $count * $order->getPrice();
				break;
			} else {
				$count -= $item_left;
				$total += $item_left * $order->getPrice();
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::UPDATE_BUY_FILLED, [
					"id" => $order->getId(),
					"filled" => $order->getFilled() + $item_left
				]);
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::UPDATE_BUY_ISFILLED, [
					"id" => $order->getId(),
					"isfilled" => true
				]);
			}
		}
		$item = ItemUtils::toItem($this->itemid);
		$item->setCount($amount);
		EconomyAPI::getInstance()->addMoney($player, $total);
		ItemUtils::removeItem($player->getInventory(), $item);
		$player->sendMessage("You have sold x" . $amount . " " . ItemUtils::toName($this->itemid) . " for " . $total . " coins.");
	}
}