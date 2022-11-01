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
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BuyOrderUI extends BaseUI{

	private string $itemid;

	public function __construct(Player $player, string $itemid){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP ORDER INFO
			$data = yield from $this->getBazaar()->getProvider()->selectBuyItem($this->itemid, true);
			if(empty($data)){
				$top_buy = "";
			}else{
				$order = OrderDataHelper::formData($data[0], OrderDataHelper::BUY);
				$top_buy = $order->getPrice();
			}
			$form = new CustomForm(function(Player $player, ?array $data){
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
				if($amount > 71680){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_amount_limit3()));
					return;
				}
				$this->confirm($player, (int) $amount, (float) $price);
			});

			$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_title()));
			$form->addLabel(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_label(ItemUtils::toName($this->itemid))));
			$form->addLabel(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_label2($top_buy)));
			$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_input_text()), FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_input_placeholder()));
			if($top_buy == ""){
				$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_input2_text()), "123456789");
			}else{
				$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_input2_text()), (string)($top_buy + 0.1));
			}

			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, float $price) : void{
		$form = new ModalForm(function(Player $player, $data) use ($amount, $price){
			if(!isset($data)) return;
			if(!$data) return;
			$this->createBuyOrder($player, $amount, $price);
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_confirm_title()));
		$form->setContent(FILang::translate($player, TranslationFactory::bazaar_ui_buyorder_confirm_content(ItemUtils::toName($this->itemid), (string)$amount, (string)$price, (string)($price * $amount))));
		$form->setButton1(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_yes()));
		$form->setButton2(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_no()));

		$player->sendForm($form);
	}

	public function createBuyOrder(Player $player, int $amount, float $price) : void{
		Await::f2c(function() use ($player, $amount, $price){
			if(($amount * $price) > EconomyAPI::getInstance()->myMoney($player)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_buyorder_create_fail_notenoughmoney()));
				return;
			}
			$args = [
				"player" => $player->getName(),
				"price" => $price,
				"amount" => $amount,
				"filled" => 0,
				"itemID" => $this->itemid,
				"time" => time(),
				"isfilled" => false
			];
			$order = OrderDataHelper::fromSqlQueryData($args, OrderDataHelper::BUY);
			$ev = new PlayerCreateOrderEvent($player, $order);
			$ev->call();
			if($ev->isCancelled()) return;
			yield $this->getBazaar()->getProvider()->registerBuy($order);
			EconomyAPI::getInstance()->reduceMoney($player, $amount * $price);
			$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_buyorder_create_success()));
		});
	}
}