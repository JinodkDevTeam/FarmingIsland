<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\Bazaar;
use Bazaar\order\BuyOrder;
use Bazaar\provider\SqliteProvider;
use Bazaar\utils\OrderDataHelper;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\Server;
use SOFe\AwaitGenerator\Await;

class BuyOrderManagerUI{
	public function __construct(Player $player, int $order_id){
		$this->execute($player, $order_id);
	}

	public function execute(Player $player, int $order_id) : void{
		Await::f2c(function() use ($player, $order_id){
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ID, ["id" => $order_id]);
			if(empty($data)) return;
			$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
			$form = new SimpleForm(function(Player $player, ?int $data) use ($order){
				if(!isset($data)) return;
				if($data == 0) $this->cancel($player, $order);
			});
			$form->setTitle("Buy Order Manager");
			$msg = [
				"Order ID: " . $order->getId(),
				"Item: " . ItemUtils::toName($order->getItemID()),
				"Total price: " . $order->getPrice() * $order->getAmount() . " coin",
				"Price per item: " . $order->getPrice(),
				"Amount: " . $order->getAmount(),
				"Filled: " . $order->getFilled(),
			];
			$form->setContent(implode("\n", $msg));
			$form->addButton("Cancel order !");
			$player->sendForm($form);
		});
	}

	public function getBazaar() : ?Bazaar{
		$bazaar = Server::getInstance()->getPluginManager()->getPlugin("BazaarShop");
		if($bazaar instanceof Bazaar){
			return $bazaar;
		}
		return null;
	}

	public function cancel(Player $player, BuyOrder $order) : void{
		$form = new ModalForm(function(Player $player, $data) use ($order){
			if(!isset($data)) return;
			if($data == true){
				$item = ItemUtils::toItem($order->getItemID());
				$item->setCount($order->getFilled());
				if(!$player->getInventory()->canAddItem($item)){
					$player->sendMessage("Your inventory doesnt have enough space to add items, make sure you have enough space and try again !");
					return;
				}
				$player->getInventory()->addItem($item);
				EconomyAPI::getInstance()->addMoney($player, ($order->getPrice() * $order->getAmount()) - ($order->getPrice() * $order->getFilled()));
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::REMOVE_BUY, ["id" => $order->getId()]);

				$player->sendMessage("Order cancelled !");
			}
		});

		$form->setTitle("Confirm !");
		$content = [
			"Cancel this order ???",
			"You will gain:",
			" - " . ($order->getPrice() * $order->getAmount()) - ($order->getPrice() * $order->getFilled()) . " coins",
			" - " . $order->getFilled() . " " . ItemUtils::toName($order->getItemID())
		];
		$form->setContent(implode("\n", $content));
		$form->setButton1("YES");
		$form->setButton2("NO");

		$player->sendForm($form);
	}


}