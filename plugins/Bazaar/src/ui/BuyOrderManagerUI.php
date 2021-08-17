<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\Bazaar;
use Bazaar\utils\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use Bazaar\utils\ItemUtils;
use jojoe77777\FormAPI\SimpleForm;
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
			if (empty($data)) return;
			$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
			$form = new SimpleForm(function(Player $player, ?int $data){
				//TODO: Implement Manager.
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
			$form->addButton("Claim items and remove order !");
			$player->sendForm($form);
		});
	}

	public function getBazaar(): ?Bazaar{
		$bazaar = Server::getInstance()->getPluginManager()->getPlugin("BazaarShop");
		if ($bazaar instanceof Bazaar){
			return $bazaar;
		}
		return null;
	}
}