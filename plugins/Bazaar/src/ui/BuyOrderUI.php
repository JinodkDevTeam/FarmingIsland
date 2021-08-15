<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\order\OrderDataHelper;
use Bazaar\provider\SqliteProvider;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BuyOrderUI extends BaseUI{

	private int $itemid;

	public function __construct(Player $player, int $itemid){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP ORDER INFO
			$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $this->itemid]);
			if (empty($data)){
				$top_buy = 0;
			} else {
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
				$top_buy = $order->getPrice();
			}
			$form = new CustomForm(function(Player $player, ?array $data){
				if (!isset($data)) return;
				if ((!isset($data[1])) or (!isset($data[2]))) return;
				$amount = $data[1];
				$price = $data[2];
				if (!(is_numeric($amount) and is_numeric($price))){
					$player->sendMessage("Amount or Price must be numeric !");
					return;
				}
				if (is_int($amount)){
					$player->sendMessage("Amount must be a integer number !");
					return;
				}
				if ((int)$amount <= 0){
					$player->sendMessage("Amount must be > 0 !");
					return;
				}
				if ((float)$price <= 0){
					$player->sendMessage("Price must be > 0 !");
					return;
				}
				$this->createBuyOrder($player, (int)$amount, (float)$price);
			});

			$form->setTitle("Create buy order");
			$form->addLabel("Current top buy order: " . $top_buy);
			$form->addInput("Amount:", "Max: 71680");
			$form->addInput("Price per item:", (string) ($top_buy + 0.1));

			$player->sendForm($form);
		});
	}

	public function createBuyOrder(Player $player, int $amount, float $price){
		$this->getBazaar()->getProvider()->executeChange(SqliteProvider::REGISTER_BUY, [
			"player" => $player->getName(),
			"price" => $price,
			"amount" => $amount,
			"filled" => 0,
			"itemID" => $this->itemid,
			"time" => time()
		]);

		$player->sendMessage("Buy order created !");
	}
}