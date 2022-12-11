<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\utils\OrderDataHelper;
use FILang\FILang;
use FILang\TranslationFactory;
use JinodkDevTeam\utils\ItemUtils;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class InstantSell extends BaseUI{

	private string $itemid;

	public function __construct(Player $player, string $itemid = ""){
		$this->itemid = $itemid;
		parent::__construct($player);
	}

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			//GETTING TOP BUY ORDER...
			$data = yield from $this->getBazaar()->getProvider()->selectBuyItem($this->itemid, true);
			if (empty($data)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_instantsell_fail_none()));
				return;
			}
			$max = ItemUtils::getItemCount($player->getInventory(), ItemUtils::toItem($this->itemid));
			$form = new CustomForm(function(Player $player, ?array $pos){
				if(!isset($pos[1])) return;
				$amount = $pos[1];
				if(is_int($amount)){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_amount_limit1()));
					return;
				}
				if((int) $amount <= 0){
					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_amount_limit2()));
					return;
				}
				//Recheck
				Await::f2c(function() use ($player, $amount){
					$data = yield from $this->getBazaar()->getProvider()->selectBuyItem($this->itemid, true);
					if (empty($data)){
						$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_instantsell_fail_none()));
						return;
					}
					$max = ItemUtils::getItemCount($player->getInventory(), ItemUtils::toItem($this->itemid));
					if($amount > $max){
						$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_instantsell_fail_notenough()));
						return;
					}
					$this->confirm($player, (int) $amount, $data);
				});
			});

			$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_title()));
			$form->addLabel(FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_label(ItemUtils::toName($this->itemid))));
			$form->addInput(FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_input_text()), FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_input_placeholder((string)$max)));
			$player->sendForm($form);
		});
	}

	public function confirm(Player $player, int $amount, array $data) : void{
		$total = 0;
		$count = $amount;
		foreach($data as $arrayOrder){
			$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::BUY);
			$item_left = $order->getAmount() - $order->getFilled();
			if($count <= $item_left){
				$total += $count * $order->getPrice();
				$count = 0;
				break;
			}else{
				$count -= $item_left;
				$total += $item_left * $order->getPrice();
			}
		}
		if($count > 0){
			$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_instantsell_fail_toomuch((string)($amount - $count))));
			return;
		}

		$form = new ModalForm(function(Player $player, $value) use ($amount, $total, $data){
			if(!isset($value)) return;
			if(!$value) return;
			$this->instantSell($player, $amount, $data);
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_confirm_title()));
		$form->setContent(FILang::translate($player, TranslationFactory::bazaar_ui_instantsell_confirm_content(ItemUtils::toName($this->itemid), (string)$amount, (string)$total)));
		$form->setButton1(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_yes()));
		$form->setButton2(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_no()));

		$player->sendForm($form);
	}

	public function instantSell(Player $player, int $amount, array $data) : void{
		Await::f2c(function() use ($player, $amount, $data){
			$total = 0;
			$count = $amount;
			foreach($data as $arrayOrder){
				$order = OrderDataHelper::formData($arrayOrder, OrderDataHelper::BUY);
				$item_left = $order->getAmount() - $order->getFilled();
				if($count <= $item_left){
					$order->setFilled($order->getFilled() + $count);
					$total += $count * $order->getPrice();
					if($count == $item_left){
						$order->setFilledStatus(true);
					}
					yield $this->getBazaar()->getProvider()->updateBuyFilled($order);
					break;
				}else{
					$count -= $item_left;
					$total += $item_left * $order->getPrice();
					$order->setFilled($order->getFilled() + $item_left);
					$order->setFilledStatus(true);
					yield $this->getBazaar()->getProvider()->updateBuyFilled($order);
				}
			}
			$item = ItemUtils::toItem($this->itemid);
			$item->setCount($amount);
			EconomyAPI::getInstance()->addMoney($player, $total);
			ItemUtils::removeItem($player->getInventory(), $item);
			$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_instantsell_success((string)$amount, ItemUtils::toName($this->itemid), (string)$total)));
		});
	}
}