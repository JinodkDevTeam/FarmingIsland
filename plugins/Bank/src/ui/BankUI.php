<?php
declare(strict_types=1);

namespace Bank\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BankUI extends BaseUI{
	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->getBank()->getProvider()->get($player);
			if(empty($data)){
				yield $this->getBank()->getProvider()->asyncRegister($player);
			}
			$data = yield from $this->getBank()->getProvider()->get($player);
			if(empty($data)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_dataerror()));
				return;
			}
			$balance = $data[0]["Money"];
			$upgrade = $data[0]["Upgrade"];
			$limit = $this->getBank()->getProvider()->getBankLimit($upgrade);
			$upgrade_name = $this->getBank()->getProvider()->getUpgradeName($upgrade);
			$purse = EconomyAPI::getInstance()->myMoney($player);
			$form = new SimpleForm(function(Player $player, ?int $data) use ($upgrade, $balance){
				if(($data == null) or ($data == 0)) return;

				match ($data) {
					1 => new DepositUI($player, $this->getBank(), $balance, $upgrade),
					2 => new WithdrawUI($player, $this->getBank(), $balance),
					3 => new UpgradeAccountUI($player, $this->getBank())
				};
			});

			$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_main_title()));
			$content = [
				FILang::translate($player, TranslationFactory::bank_ui_main_content_balance((string)$balance)),
				FILang::translate($player, TranslationFactory::bank_ui_main_content_purse((string)$purse)),
				FILang::translate($player, TranslationFactory::bank_ui_main_content_account($upgrade_name)),
				FILang::translate($player, TranslationFactory::bank_ui_main_content_balancelimit((string)$limit))
			];
			$form->setContent(implode("\n", $content));
			$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_main_button_exit()));
			$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_main_button_deposit()));
			$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_main_button_withdraw()));
			$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_main_button_upgrade()));

			$player->sendForm($form);
		});
	}
}