<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\provider\SqliteProvider;
use Bazaar\utils\OrderDataHelper;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ListOrderUI extends BaseUI{

	public const BUY = 0;
	public const SELL = 1;

	protected int $mode;
	protected int $item_id;

	public function __construct(Player $player, int $item_id, $mode){
		$this->item_id = $item_id;
		$this->mode = $mode;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			switch($this->mode){
				case self::BUY:
					$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_BUY_ITEMID_SORT_PRICE, ["itemid" => $this->item_id]);
					$title = "List Buy Order";
					break;
				case self::SELL:
					$data = yield $this->getBazaar()->getProvider()->asyncSelect(SqliteProvider::SELECT_SELL_ITEMID_SORT_PRICE, ["itemid" => $this->item_id]);
					$title = "List Sell Order";
					break;
				default:
					return;
			}
			if (empty($data)){
				$player->sendMessage("This item doesnt have any order !");
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
				array_push($msg, "#" . $count . " " . $order->getAmount() - $order->getFilled() . "x | " . $order->getPrice() . " coins each");
			}
			$form->setContent(implode("\n", $msg));
			$player->sendForm($form);
		});
	}
}