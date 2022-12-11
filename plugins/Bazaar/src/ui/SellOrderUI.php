<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\event\PlayerCreateOrderEvent;
use Bazaar\utils\OrderDataHelper;
use FILang\FILang;
use FILang\TranslationFactory;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class SellOrderUI extends BaseUI{

	private string $itemid;

	public function __construct(Player $player, string $itemid){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP ORDER INFO
			$data = yield from $this->getBazaar()->getProvider()->selectSellItem($this->itemid, true);
			if(empty($data)){
				$top_sell = "";
			}else{
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
				$top_sell = $order->getPrice();
			}
			$max = ItemUtils::getItemCount($player->getInventory(), ItemUtils::toItem($this->itemid));

			$form = new CustomForm(function(Player $player, ?array $data) use ($max){
				if(!isset($data)) return;
				if((!isset($data[2])) or (!isset($data[3]))) return;
				$amount = $data[2];
				$price = $data[3];
				if(!(is_numeric($amount) and is_numeric($price))){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_price_limit1()));
					return;
				}
				if(is_int($amount)){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_amount_limit1()));
					return;
				}
				if((int) $amount <= 0){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_amount_limit2()));
					return;
				}
				if((float) $price <= 0){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_price_limit2()));
					return;
				}
				if($amount > $max){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_sellorder_create_fail_notenoughitem()));
					return;
				}

				$this->confirm($player, (int) $amount, (float) $price);
			});

			$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_title()));
			$form->addLabel(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_label(ItemUtils::toName($this->itemid))));
			$form->addLabel(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_label2((string) $top_sell)));
			$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_input_text()), FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_input_placeholder((string) $max)));
			if($top_sell == ""){
				$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_input2_text()), "123456789");
			}else{
				$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_input2_text()), (string) ($top_sell - 0.1));
			}

			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, float $price) : void{
		$form = new ModalForm(function(Player $player, $data) use ($amount, $price){
			if(!isset($data)) return;
			if(!$data) return;
			$this->createSellOrder($player, $amount, $price);
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_confirm_title()));
		$form->setContent(FILang::translate($player, TranslationFactory::bazaar_ui_sellorder_confirm_content(ItemUtils::toName($this->itemid), (string) $amount, (string) $price, (string) ($price * $amount))));
		$form->setButton1(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_yes()));
		$form->setButton2(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_no()));

		$player->sendForm($form);
	}

	public function createSellOrder(Player $player, int $amount, float $price){
		Await::f2c(function() use ($player, $amount, $price){
			$args = [
				"player" => $player->getName(),
				"price" => $price,
				"amount" => $amount,
				"filled" => 0,
				"itemID" => $this->itemid,
				"time" => time(),
				"isfilled" => false
			];
			$order = OrderDataHelper::fromSqlQueryData($args, OrderDataHelper::SELL);
			$ev = new PlayerCreateOrderEvent($player, $order);
			$ev->call();
			if($ev->isCancelled()) return;
			yield $this->getBazaar()->getProvider()->registerSell($order);
			$item = ItemUtils::toItem($this->itemid);
			$item->setCount($amount);
			ItemUtils::removeItem($player->getInventory(), $item);
			$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_sellorder_create_success()));
		});
	}
}