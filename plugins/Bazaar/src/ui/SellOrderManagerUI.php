<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\Bazaar;
use Bazaar\order\SellOrder;
use Bazaar\utils\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use Bazaar\utils\ItemUtils;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\Server;
use SOFe\AwaitGenerator\Await;

class SellOrderManagerUI{
	public function __construct(Player $player, int $order_id){
		$this->execute($player, $order_id);
	}

	public function execute(Player $player, int $order_id) : void{
		Await::f2c(function() use ($player, $order_id){
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ID, ["id" => $order_id]);
			if (empty($data)) return;
			$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
			$form = new SimpleForm(function(Player $player, ?int $data){
				//TODO: Implement Manager.
			});
			$form->setTitle("Sell Order Manager");
			$msg = [
				"Order ID: " . $order->getId(),
				"Item: " . ItemUtils::toName($order->getItemID()),
				"Worth: " . $order->getPrice() * $order->getAmount() . " coin",
				"Price per item: " . $order->getPrice(),
				"Amount: " . $order->getAmount(),
				"Filled: " . $order->getFilled(),
			];
			$form->setContent(implode("\n", $msg));
			$form->addButton("Claim money and remove order !");
			$player->sendForm($form);
		});
	}

	public function cancel(Player $player, SellOrder $order): void{
		$form = new ModalForm(function(Player $player, $data) use ($order){
			if (!isset($data)) return;
			if ($data == true){
				$item = ItemUtils::toItem($order->getItemID());
				$item->setCount($order->getAmount() - $order->getFilled());
				if (!$player->getInventory()->canAddItem($item)){
					$player->sendMessage("Your inventory doesnt have enough space to add items, make sure you have enough space and try again !");
					return;
				}
				EconomyAPI::getInstance()->addMoney($player, $order->getFilled() * $order->getPrice());
				$this->getBazaar()->getProvider()->executeChange(SqliteProvider::REMOVE_SELL, ["id" => $order->getId()]);

				$player->sendMessage("Order cancelled !");
			}
		});

		$form->setTitle("Confirm !");
		$content = [
			"Cancel this order ???",
			"You will gain:",
			" - " . $order->getFilled() * $order->getPrice() . " coins",
			" - " . $order->getAmount() - $order->getFilled() . " " . ItemUtils::toName($order->getItemID())
		];
		$form->setContent(implode("\n", $content));
		$form->setButton1("YES");
		$form->setButton2("NO");

		$player->sendForm($form);
	}

	public function getBazaar(): ?Bazaar{
		$bazaar = Server::getInstance()->getPluginManager()->getPlugin("BazaarShop");
		if ($bazaar instanceof Bazaar){
			return $bazaar;
		}
		return null;
	}
}