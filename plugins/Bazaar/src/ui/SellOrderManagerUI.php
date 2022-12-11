<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\Bazaar;
use Bazaar\order\SellOrder;
use Bazaar\utils\OrderDataHelper;
use FILang\FILang;
use FILang\TranslationFactory;
use JinodkDevTeam\utils\ItemUtils;
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
			$data = yield from $this->getBazaar()->getProvider()->selectSell($order_id);
			if(empty($data)) return;
			$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
			$form = new SimpleForm(function(Player $player, ?int $value) use ($order_id){
				if(!isset($value)) return;
				if($value == 0) {
					//Recheck
					Await::f2c(function() use ($player, $order_id){
						$data = yield from $this->getBazaar()->getProvider()->selectSell($order_id);
						if(empty($data)) return;
						$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
						$this->cancel($player, $order);
					});
				}
			});
			$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_title()));
			$msg = [
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_id((string)$order->getId())),
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_item(ItemUtils::toName($order->getItemID()))),
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_total((string)($order->getPrice() * $order->getAmount()))),
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_each((string)$order->getPrice())),
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_amount((string)$order->getAmount())),
				FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_content_filled((string)$order->getFilled())),
			];
			$form->setContent(implode("\n", $msg));
			$form->addButton(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_button_cancel()));
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

	public function cancel(Player $player, SellOrder $order) : void{
		$form = new ModalForm(function(Player $player, $value) use ($order){
			if(!isset($value)) return;
			$order_id = $order->getId();
			if($value){
				Await::f2c(function() use ($player, $order_id){
					//Recheck AGAIN
					$data = yield from $this->getBazaar()->getProvider()->selectSell($order_id);
					if(empty($data)) return;
					$order = OrderDataHelper::formData($data[0], OrderDataHelper::SELL);
					$item = ItemUtils::toItem($order->getItemID());
					$item->setCount($order->getAmount() - $order->getFilled());
					if(!$player->getInventory()->canAddItem($item)){
						$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_invfull()));
						return;
					}
					$player->getInventory()->addItem($item);
					EconomyAPI::getInstance()->addMoney($player, $order->getFilled() * $order->getPrice());
					yield $this->getBazaar()->getProvider()->removeSell($order);

					$player->sendMessage(FILang::translate($player, TranslationFactory::bazaar_order_cancel_success()));
				});
			}
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_cancel_title()));
		$content = [
			FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_cancel_content_msg()),
			FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_cancel_content_msg2()),
			FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_cancel_content_msg3((string)($order->getFilled() * $order->getPrice()))),
			FILang::translate($player, TranslationFactory::bazaar_ui_myorder_manager_sell_cancel_content_msg4((string)($order->getAmount() - $order->getFilled()), ItemUtils::toName($order->getItemID())))
		];
		$form->setContent(implode("\n", $content));
		$form->setButton1(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_yes()));
		$form->setButton2(FILang::translate($player, TranslationFactory::bazaar_ui_confirm_button_no()));

		$player->sendForm($form);
	}
}