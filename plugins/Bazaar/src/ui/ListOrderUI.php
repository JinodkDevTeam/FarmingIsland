<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ListOrderUI extends BaseUI{

	public const BUY = 0;
	public const SELL = 1;

	protected int $mode;
	protected string $item_id;

	public function __construct(Player $player, string $item_id, $mode){
		$this->item_id = $item_id;
		$this->mode = $mode;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			switch($this->mode){
				case self::BUY:
					$data = yield from $this->getBazaar()->getProvider()->selectBuyItem($this->item_id, true);
					$title = "List Buy Order";
					break;
				case self::SELL:
					$data = yield from $this->getBazaar()->getProvider()->selectSellItem($this->item_id, true);
					$title = "List Sell Order";
					break;
				default:
					return;
			}
			if (empty($data)){
				if ($this->mode == self::BUY){
					$player->sendMessage("Noone want to buy this item.");
				} else {
					$player->sendMessage("Noone sell this item.");
				}
				return;
			}

			$form = new SimpleForm(function(Player $player, ?int $data){
				//NOOOP
			});
			$form->setTitle($title);
			$form->addButton("OK");
			$count = 0;
			$msg = [
				"Rank | Amount | Price"
			];
			foreach($data as $o){
				$count++;
				$order = OrderDataHelper::formData($o, $this->mode);
				$msg[] = "#" . $count . " " . $order->getAmount() - $order->getFilled() . "x | " . $order->getPrice() . " coins each";
				if ($count > 9){
					break;
				}
			}
			$form->setContent(implode("\n", $msg));
			$player->sendForm($form);
		});
	}
}