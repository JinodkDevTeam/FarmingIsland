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

class WithdrawUI extends BaseUI{
	private float $balance;

	public function __construct(Player $player, Bank $bank, float $balance){
		$this->balance = $balance;
		parent::__construct($player, $bank);
	}

	public function execute(Player $player) : void{
		$all = $this->balance;
		$half = round($this->balance / 2, 2, PHP_ROUND_HALF_DOWN);
		$min = round($this->balance / 5, 2, PHP_ROUND_HALF_DOWN);

		$form = new SimpleForm(function(Player $player, ?int $data) use ($all, $half, $min){
			if($data == null) return;

			switch($data){
				case 0:
					new BankUI($player, $this->getBank());
					break;
				case 1:
					$this->withdraw($player, $all);
					break;
				case 2:
					$this->withdraw($player, $half);
					break;
				case 3:
					$this->withdraw($player, $min);
					break;
				case 4:
					$this->specificAmount($player);
					break;
			}
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_withdraw_title()));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_withdraw_button_back()));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_withdraw_button_all((string)$all)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_withdraw_button_half((string)$half)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_withdraw_button_20((string)$min)));
		$form->addButton(FILang::translate($player, TranslationFactory::bank_ui_withdraw_button_custom()));

		$player->sendForm($form);
	}

	public function withdraw(Player $player, float $amount) : void{
		if($amount > $this->balance){
			$player->sendMessage(FILang::translate($player, TranslationFactory::bank_withdraw_fail()));
			return;
		}
		$this->getBank()->getProvider()->updateBalance($player, $this->balance - $amount);
		EconomyAPI::getInstance()->addMoney($player, $amount);
		$player->sendMessage(FILang::translate($player, TranslationFactory::bank_withdraw_success((string)$amount)));
	}

	public function specificAmount(Player $player){
		$form = new CustomForm(function(Player $player, ?array $data){
			if($data == null) return;
			if(!is_numeric($data[0])){
				$player->sendMessage(FILang::translate($player, TranslationFactory::bank_notnumeric()));
				return;
			}
			$this->withdraw($player, (float) $data[0]);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::bank_ui_withdraw_custom_title()));
		$form->addInput(FILang::translate($player, TranslationFactory::bank_ui_withdraw_custom_input()), "123456789");

		$player->sendForm($form);
	}
}