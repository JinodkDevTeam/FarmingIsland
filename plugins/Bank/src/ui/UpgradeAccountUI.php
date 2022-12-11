<?php
declare(strict_types=1);

namespace Bank\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\ModalForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class UpgradeAccountUI extends BankUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->getBank()->getProvider()->get($player);
			if(empty($data)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_dataerror()));
				return;
			}
			$current_upgrade = (int) $data[0]["Upgrade"];
			$current_upgrade_name = $this->getBank()->getProvider()->getUpgradeName($current_upgrade);
			$next_upgrade_name = $this->getBank()->getProvider()->getUpgradeName($current_upgrade + 1);
			$next_upgrade_cost = $this->getBank()->getProvider()->getUpgradeCost($current_upgrade + 1);
			$max_upgrade = $this->getBank()->getProvider()->getMaxUpgrade();
			if($current_upgrade >= $max_upgrade){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_upgrade_max()));
				return;
			}
			$form = new ModalForm(function(Player $player, ?bool $value) use ($next_upgrade_cost, $current_upgrade){
				$purse = EconomyAPI::getInstance()->myMoney($player);
				if(is_null($value)) return;
				if (!$value){
					return;
				}
				if ($purse < $next_upgrade_cost) {
					$player->sendMessage(FILang::translate($player, TranslationFactory::bank_upgrade_fail((string)$next_upgrade_cost, (string)$purse)));
					return;
				}
				EconomyAPI::getInstance()->reduceMoney($player, $next_upgrade_cost);
				$this->getBank()->getProvider()->updateUpgrade($player, $current_upgrade + 1);
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_upgrade_success()));
			});
			$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_upgrade_title()));
			$content = [
				FILang::translate($player, TranslationFactory::bank_ui_upgrade_content_msg()),
				FILang::translate($player, TranslationFactory::bank_ui_upgrade_content_current($current_upgrade_name)),
				FILang::translate($player, TranslationFactory::bank_ui_upgrade_content_next($next_upgrade_name)),
				FILang::translate($player, TranslationFactory::bank_ui_upgrade_content_cost((string)$next_upgrade_cost)),
			];
			$form->setContent(implode("\n", $content));
			$form->setButton1(FILang::translate($player, TranslationFactory::bank_ui_upgrade_button_yes()));
			$form->setButton2(FILang::translate($player, TranslationFactory::bank_ui_upgrade_button_no()));
			$player->sendForm($form);
		});
	}
}