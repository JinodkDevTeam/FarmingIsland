<?php
declare(strict_types=1);

namespace FILang;

use pocketmine\lang\Translatable;

final class TranslationFactory{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See ngtools\TranslationKeysGenerator.php
 	*/
	public static function language_name() : Translatable{
		return new Translatable(TranslationKeys::LANGUAGE_NAME, []);
	}

	public static function language_version() : Translatable{
		return new Translatable(TranslationKeys::LANGUAGE_VERSION, []);
	}

	public static function command_ingame() : Translatable{
		return new Translatable(TranslationKeys::COMMAND_INGAME, []);
	}

	public static function backpack_nothave() : Translatable{
		return new Translatable(TranslationKeys::BACKPACK_NOTHAVE, []);
	}

	public static function backpack_openfail() : Translatable{
		return new Translatable(TranslationKeys::BACKPACK_OPENFAIL, []);
	}

	public static function backback_openfail2() : Translatable{
		return new Translatable(TranslationKeys::BACKBACK_OPENFAIL2, []);
	}

	public static function backpack_ui_title() : Translatable{
		return new Translatable(TranslationKeys::BACKPACK_UI_TITLE, []);
	}

	public static function backpack_ui_button(Translatable|string $slotID) : Translatable{
		return new Translatable(TranslationKeys::BACKPACK_UI_BUTTON, [
			"slotID" => $slotID,
		]);
	}

	public static function backpack_gui_name(Translatable|string $slotID) : Translatable{
		return new Translatable(TranslationKeys::BACKPACK_GUI_NAME, [
			"slotID" => $slotID,
		]);
	}

	public static function bank_dataerror() : Translatable{
		return new Translatable(TranslationKeys::BANK_DATAERROR, []);
	}

	public static function bank_deposit_notnumeric() : Translatable{
		return new Translatable(TranslationKeys::BANK_DEPOSIT_NOTNUMERIC, []);
	}

	public static function bank_deposit_fail() : Translatable{
		return new Translatable(TranslationKeys::BANK_DEPOSIT_FAIL, []);
	}

	public static function bank_deposit_success(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_DEPOSIT_SUCCESS, [
			"amount" => $amount,
		]);
	}

	public static function bank_withdraw_fail() : Translatable{
		return new Translatable(TranslationKeys::BANK_WITHDRAW_FAIL, []);
	}

	public static function bank_withdraw_success(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_WITHDRAW_SUCCESS, [
			"amount" => $amount,
		]);
	}

	public static function bank_upgrade_max() : Translatable{
		return new Translatable(TranslationKeys::BANK_UPGRADE_MAX, []);
	}

	public static function bank_upgrade_fail(Translatable|string $need, Translatable|string $have) : Translatable{
		return new Translatable(TranslationKeys::BANK_UPGRADE_FAIL, [
			"need" => $need,
			"have" => $have,
		]);
	}

	public static function bank_upgrade_success() : Translatable{
		return new Translatable(TranslationKeys::BANK_UPGRADE_SUCCESS, []);
	}

	public static function bank_ui_main_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_TITLE, []);
	}

	public static function bank_ui_main_content_balance(Translatable|string $balance) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_CONTENT_BALANCE, [
			"balance" => $balance,
		]);
	}

	public static function bank_ui_main_content_purse(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_CONTENT_PURSE, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_main_content_account(Translatable|string $accountType) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_CONTENT_ACCOUNT, [
			"accountType" => $accountType,
		]);
	}

	public static function bank_ui_main_content_balancelimit(Translatable|string $limit) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_CONTENT_BALANCELIMIT, [
			"limit" => $limit,
		]);
	}

	public static function bank_ui_main_button_exit() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_BUTTON_EXIT, []);
	}

	public static function bank_ui_main_button_deposit() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_BUTTON_DEPOSIT, []);
	}

	public static function bank_ui_main_button_withdraw() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_BUTTON_WITHDRAW, []);
	}

	public static function bank_ui_main_button_upgrade() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_MAIN_BUTTON_UPGRADE, []);
	}

	public static function bank_ui_deposit_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_TITLE, []);
	}

	public static function bank_ui_deposit_button_back() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_BUTTON_BACK, []);
	}

	public static function bank_ui_deposit_button_all(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_BUTTON_ALL, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_deposit_button_half(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_BUTTON_HALF, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_deposit_button_20(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_BUTTON_20, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_deposit_button_custom() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_BUTTON_CUSTOM, []);
	}

	public static function bank_ui_deposit_custom_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_CUSTOM_TITLE, []);
	}

	public static function bank_ui_deposit_custom_input() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_DEPOSIT_CUSTOM_INPUT, []);
	}

	public static function bank_ui_withdraw_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_TITLE, []);
	}

	public static function bank_ui_withdraw_button_back() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_BUTTON_BACK, []);
	}

	public static function bank_ui_withdraw_button_all(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_BUTTON_ALL, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_withdraw_button_half(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_BUTTON_HALF, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_withdraw_button_20(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_BUTTON_20, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_withdraw_button_custom() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_BUTTON_CUSTOM, []);
	}

	public static function bank_ui_withdraw_custom_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_CUSTOM_TITLE, []);
	}

	public static function bank_ui_withdraw_custom_input() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_WITHDRAW_CUSTOM_INPUT, []);
	}

	public static function bank_ui_upgrade_title() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_TITLE, []);
	}

	public static function bank_ui_upgrade_content_msg() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_CONTENT_MSG, []);
	}

	public static function bank_ui_upgrade_content_current(Translatable|string $currentUpgrade) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_CONTENT_CURRENT, [
			"currentUpgrade" => $currentUpgrade,
		]);
	}

	public static function bank_ui_upgrade_content_next(Translatable|string $nextUpgrade) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_CONTENT_NEXT, [
			"nextUpgrade" => $nextUpgrade,
		]);
	}

	public static function bank_ui_upgrade_content_cost(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_CONTENT_COST, [
			"amount" => $amount,
		]);
	}

	public static function bank_ui_upgrade_button_yes() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_BUTTON_YES, []);
	}

	public static function bank_ui_upgrade_button_no() : Translatable{
		return new Translatable(TranslationKeys::BANK_UI_UPGRADE_BUTTON_NO, []);
	}

	public static function bazaar_ui_main_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MAIN_TITLE, []);
	}

	public static function bazaar_ui_main_button_myorders() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MAIN_BUTTON_MYORDERS, []);
	}

	public static function bazaar_ui_main_button_shop() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MAIN_BUTTON_SHOP, []);
	}

	public static function bazaar_ui_myorder_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_TITLE, []);
	}

	public static function bazaar_ui_myorder_button_order_buy(Translatable|string $itemName, Translatable|string $percent) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_BUTTON_ORDER_BUY, [
			"itemName" => $itemName,
			"percent" => $percent,
		]);
	}

	public static function bazaar_ui_myorder_button_order_sell(Translatable|string $itemName, Translatable|string $percent) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_BUTTON_ORDER_SELL, [
			"itemName" => $itemName,
			"percent" => $percent,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_TITLE, []);
	}

	public static function bazaar_ui_myorder_manager_buy_content_id(Translatable|string $orderID) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_ID, [
			"orderID" => $orderID,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_content_item(Translatable|string $item) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_ITEM, [
			"item" => $item,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_content_total(Translatable|string $price) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_TOTAL, [
			"price" => $price,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_content_each(Translatable|string $priceEach) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_EACH, [
			"priceEach" => $priceEach,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_content_amount(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_AMOUNT, [
			"amount" => $amount,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_content_filled(Translatable|string $filled) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CONTENT_FILLED, [
			"filled" => $filled,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_button_cancel() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_BUTTON_CANCEL, []);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_TITLE, []);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_content_msg() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_CONTENT_MSG, []);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_content_msg2() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_CONTENT_MSG2, []);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_content_msg3(Translatable|string $coins) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_CONTENT_MSG3, [
			"coins" => $coins,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_content_msg4(Translatable|string $amount, Translatable|string $item) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_CONTENT_MSG4, [
			"amount" => $amount,
			"item" => $item,
		]);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_button_yes() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_BUTTON_YES, []);
	}

	public static function bazaar_ui_myorder_manager_buy_cancel_button_no() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_BUY_CANCEL_BUTTON_NO, []);
	}

	public static function bazaar_ui_myorder_manager_sell_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_TITLE, []);
	}

	public static function bazaar_ui_myorder_manager_sell_content_id(Translatable|string $orderID) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_ID, [
			"orderID" => $orderID,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_content_item(Translatable|string $item) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_ITEM, [
			"item" => $item,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_content_total(Translatable|string $price) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_TOTAL, [
			"price" => $price,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_content_each(Translatable|string $priceEach) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_EACH, [
			"priceEach" => $priceEach,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_content_amount(Translatable|string $amount) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_AMOUNT, [
			"amount" => $amount,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_content_filled(Translatable|string $filled) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CONTENT_FILLED, [
			"filled" => $filled,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_button_cancel() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_BUTTON_CANCEL, []);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_TITLE, []);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_content_msg() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_CONTENT_MSG, []);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_content_msg2() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_CONTENT_MSG2, []);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_content_msg3(Translatable|string $coins) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_CONTENT_MSG3, [
			"coins" => $coins,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_content_msg4(Translatable|string $amount, Translatable|string $item) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_CONTENT_MSG4, [
			"amount" => $amount,
			"item" => $item,
		]);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_button_yes() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_BUTTON_YES, []);
	}

	public static function bazaar_ui_myorder_manager_sell_cancel_button_no() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_MYORDER_MANAGER_SELL_CANCEL_BUTTON_NO, []);
	}

	public static function bazaar_invfull() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INVFULL, []);
	}

	public static function bazaar_order_cancel_success() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_ORDER_CANCEL_SUCCESS, []);
	}

	public static function clearlagg_timeleft(Translatable|string $seconds) : Translatable{
		return new Translatable(TranslationKeys::CLEARLAGG_TIMELEFT, [
			"seconds" => $seconds,
		]);
	}

	public static function clearlagg_cleared(Translatable|string $cleared) : Translatable{
		return new Translatable(TranslationKeys::CLEARLAGG_CLEARED, [
			"cleared" => $cleared,
		]);
	}

	public static function dailyreward_menu_name() : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_MENU_NAME, []);
	}

	public static function dailyreward_menu_claimed() : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_MENU_CLAIMED, []);
	}

	public static function dailyreward_menu_prizename(Translatable|string $day) : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_MENU_PRIZENAME, [
			"day" => $day,
		]);
	}

	public static function dailyreward_claim_fail_miss() : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_CLAIM_FAIL_MISS, []);
	}

	public static function dailyreward_claim_fail_cooldown() : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_CLAIM_FAIL_COOLDOWN, []);
	}

	public static function dailyreward_claim_fail_invalid() : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_CLAIM_FAIL_INVALID, []);
	}

	public static function dailyreward_claim_success(Translatable|string $coins) : Translatable{
		return new Translatable(TranslationKeys::DAILYREWARD_CLAIM_SUCCESS, [
			"coins" => $coins,
		]);
	}

	public static function favis_command_notislandworld() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_COMMAND_NOTISLANDWORLD, []);
	}

}
