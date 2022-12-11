<?php
declare(strict_types=1);

namespace Bank\ui;

use Bank\Bank;
use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;

class DepositUI extends BaseUI{
	private float $balance;
	private int $upgrade;

	public function __construct(Player $player, Bank $bank, float $balance, int $upgrade){
		$this->balance = $balance;
		$this->upgrade = $upgrade;
		parent::__construct($player, $bank);
	}

	public function execute(Player $player) : void{
		$purse = EconomyAPI::getInstance()->myMoney($player);
		$all = $purse;
		$half = round($purse / 2, 2, PHP_ROUND_HALF_DOWN);
		$min = round($purse / 5, 2, PHP_ROUND_HALF_DOWN);

		$form = new SimpleForm(function(Player $player, ?int $data) use ($all, $half, $min){
			if($data == null) return;

			switch($data){
				case 0:
					new BankUI($player, $this->getBank());
					break;
				case 1:
					$this->deposit($player, $all);
					break;
				case 2:
					$this->deposit($player, $half);
					break;
				case 3:
					$this->deposit($player, $min);
					break;
				case 4:
					$this->specificAmount($player);
					break;
			}
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_deposit_title()));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_deposit_button_back()));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_deposit_button_all((string)$all)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_deposit_button_half((string)$half)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_deposit_button_20((string)$min)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_deposit_button_custom()));

		$player->sendForm($form);
	}

	public function deposit(Player $player, float $amount) : void{
		$purse = EconomyAPI::getInstance()->myMoney($player);

		if($amount > $purse){
			$player->sendMessage(FILang::translate($player, TranslationFactory::bank_deposit_fail()));
			return;
		}
		$limit = $this->getBank()->getProvider()->getBankLimit($this->upgrade);
		if ($limit < $this->balance + $amount) {
			$amount = $limit - $this->balance;
		}
		$this->getBank()->getProvider()->updateBalance($player, $this->balance + $amount);
		EconomyAPI::getInstance()->reduceMoney($player, $amount);
		$player->sendMessage(FILang::translate($player, TranslationFactory::bank_deposit_success((string)$amount)));
	}

	public function specificAmount(Player $player){
		$form = new CustomForm(function(Player $player, ?array $data){
			if($data == null) return;
			if(!is_numeric($data[0])){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_notnumeric()));
				return;
			}
			$this->deposit($player, (float) $data[0]);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_deposit_custom_title()));
		$form->addInput(FILang::translate($player, TranslationFactory::bank_ui_deposit_custom_input()), "123456789");

		$player->sendForm($form);
	}
}