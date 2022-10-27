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

	public static function command_noperm() : Translatable{
		return new Translatable(TranslationKeys::COMMAND_NOPERM, []);
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

	public static function bazaar_ui_shop_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SHOP_TITLE, []);
	}

	public static function bazaar_ui_shop_button(Translatable|string $itemName, Translatable|string $buyPrice, Translatable|string $sellPrice) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SHOP_BUTTON, [
			"itemName" => $itemName,
			"buyPrice" => $buyPrice,
			"sellPrice" => $sellPrice,
		]);
	}

	public static function bazaar_ui_item_title(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_TITLE, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_item_content(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_CONTENT, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_item_instantbuy(Translatable|string $price) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_INSTANTBUY, [
			"price" => $price,
		]);
	}

	public static function bazaar_ui_item_instantsell(Translatable|string $price) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_INSTANTSELL, [
			"price" => $price,
		]);
	}

	public static function bazaar_ui_item_create_buy() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_CREATE_BUY, []);
	}

	public static function bazaar_ui_item_create_sell() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_CREATE_SELL, []);
	}

	public static function bazaar_ui_item_list_buy() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_LIST_BUY, []);
	}

	public static function bazaar_ui_item_list_sell() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_ITEM_LIST_SELL, []);
	}

	public static function bazaar_ui_instantbuy_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTBUY_TITLE, []);
	}

	public static function bazaar_ui_instantbuy_label(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTBUY_LABEL, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_instantbuy_input() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTBUY_INPUT, []);
	}

	public static function bazaar_ui_instantbuy_confirm_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTBUY_CONFIRM_TITLE, []);
	}

	public static function bazaar_ui_instantbuy_confirm_content(Translatable|string $itemName, Translatable|string $amount, Translatable|string $totalPrice) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTBUY_CONFIRM_CONTENT, [
			"itemName" => $itemName,
			"amount" => $amount,
			"totalPrice" => $totalPrice,
		]);
	}

	public static function bazaar_ui_instantsell_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTSELL_TITLE, []);
	}

	public static function bazaar_ui_instantsell_label(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTSELL_LABEL, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_instantsell_input() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTSELL_INPUT, []);
	}

	public static function bazaar_ui_instantsell_confirm_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTSELL_CONFIRM_TITLE, []);
	}

	public static function bazaar_ui_instantsell_confirm_content(Translatable|string $itemName, Translatable|string $amount, Translatable|string $totalPrice) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_INSTANTSELL_CONFIRM_CONTENT, [
			"itemName" => $itemName,
			"amount" => $amount,
			"totalPrice" => $totalPrice,
		]);
	}

	public static function bazaar_ui_buyorder_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_TITLE, []);
	}

	public static function bazaar_ui_buyorder_label(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_LABEL, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_buyorder_label2(Translatable|string $topBuy) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_LABEL2, [
			"topBuy" => $topBuy,
		]);
	}

	public static function bazaar_ui_buyorder_input_text() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_INPUT_TEXT, []);
	}

	public static function bazaar_ui_buyorder_input_placeholder() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_INPUT_PLACEHOLDER, []);
	}

	public static function bazaar_ui_buyorder_input2_text() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_INPUT2_TEXT, []);
	}

	public static function bazaar_ui_buyorder_confirm_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_CONFIRM_TITLE, []);
	}

	public static function bazaar_ui_buyorder_confirm_content(Translatable|string $itemName, Translatable|string $amount, Translatable|string $priceEach, Translatable|string $price) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_BUYORDER_CONFIRM_CONTENT, [
			"itemName" => $itemName,
			"amount" => $amount,
			"priceEach" => $priceEach,
			"price" => $price,
		]);
	}

	public static function bazaar_ui_sellorder_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_TITLE, []);
	}

	public static function bazaar_ui_sellorder_label(Translatable|string $itemName) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_LABEL, [
			"itemName" => $itemName,
		]);
	}

	public static function bazaar_ui_sellorder_label2(Translatable|string $topSell) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_LABEL2, [
			"topSell" => $topSell,
		]);
	}

	public static function bazaar_ui_sellorder_input_text() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_INPUT_TEXT, []);
	}

	public static function bazaar_ui_sellorder_input_placeholder(Translatable|string $maxItem) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_INPUT_PLACEHOLDER, [
			"maxItem" => $maxItem,
		]);
	}

	public static function bazaar_ui_sellorder_input2_text() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_INPUT2_TEXT, []);
	}

	public static function bazaar_ui_sellorder_confirm_title() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_CONFIRM_TITLE, []);
	}

	public static function bazaar_ui_sellorder_confirm_content(Translatable|string $itemName, Translatable|string $amount, Translatable|string $priceEach, Translatable|string $worth) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_SELLORDER_CONFIRM_CONTENT, [
			"itemName" => $itemName,
			"amount" => $amount,
			"priceEach" => $priceEach,
			"worth" => $worth,
		]);
	}

	public static function bazaar_ui_confirm_button_yes() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_CONFIRM_BUTTON_YES, []);
	}

	public static function bazaar_ui_confirm_button_no() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_UI_CONFIRM_BUTTON_NO, []);
	}

	public static function bazaar_invfull() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INVFULL, []);
	}

	public static function bazaar_order_cancel_success() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_ORDER_CANCEL_SUCCESS, []);
	}

	public static function bazaar_instantbuy_fail_none() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTBUY_FAIL_NONE, []);
	}

	public static function bazaar_instantbuy_fail_notenough(Translatable|string $items) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTBUY_FAIL_NOTENOUGH, [
			"items" => $items,
		]);
	}

	public static function bazaar_instantbuy_fail_notenoughmoney() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTBUY_FAIL_NOTENOUGHMONEY, []);
	}

	public static function bazaar_instantbuy_success(Translatable|string $amount, Translatable|string $itemName, Translatable|string $totalPrice) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTBUY_SUCCESS, [
			"amount" => $amount,
			"itemName" => $itemName,
			"totalPrice" => $totalPrice,
		]);
	}

	public static function bazaar_instantsell_fail_none() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTSELL_FAIL_NONE, []);
	}

	public static function bazaar_instantsell_fail_notenough() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTSELL_FAIL_NOTENOUGH, []);
	}

	public static function bazaar_instantsell_fail_toomuch(Translatable|string $items) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTSELL_FAIL_TOOMUCH, [
			"items" => $items,
		]);
	}

	public static function bazaar_instantsell_success(Translatable|string $amount, Translatable|string $itemName, Translatable|string $totalPrice) : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_INSTANTSELL_SUCCESS, [
			"amount" => $amount,
			"itemName" => $itemName,
			"totalPrice" => $totalPrice,
		]);
	}

	public static function bazaar_buyorder_create_success() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_BUYORDER_CREATE_SUCCESS, []);
	}

	public static function bazaar_buyorder_create_fail_notenoughmoney() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_BUYORDER_CREATE_FAIL_NOTENOUGHMONEY, []);
	}

	public static function bazaar_sellorder_create_success() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_SELLORDER_CREATE_SUCCESS, []);
	}

	public static function bazaar_sellorder_create_fail_notenoughitem() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_SELLORDER_CREATE_FAIL_NOTENOUGHITEM, []);
	}

	public static function bazaar_amount_limit1() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_AMOUNT_LIMIT1, []);
	}

	public static function bazaar_amount_limit2() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_AMOUNT_LIMIT2, []);
	}

	public static function bazaar_amount_limit3() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_AMOUNT_LIMIT3, []);
	}

	public static function bazaar_price_limit1() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_PRICE_LIMIT1, []);
	}

	public static function bazaar_price_limit2() : Translatable{
		return new Translatable(TranslationKeys::BAZAAR_PRICE_LIMIT2, []);
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

	public static function favis_notinisland() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_NOTINISLAND, []);
	}

	public static function favis_addisland_success() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_ADDISLAND_SUCCESS, []);
	}

	public static function favis_addid_fail_unclaimed() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_ADDID_FAIL_UNCLAIMED, []);
	}

	public static function favis_addid_fail_invalidid() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_ADDID_FAIL_INVALIDID, []);
	}

	public static function favis_addid_fail_invalidformat() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_ADDID_FAIL_INVALIDFORMAT, []);
	}

	public static function favis_addid_success(Translatable|string $island) : Translatable{
		return new Translatable(TranslationKeys::FAVIS_ADDID_SUCCESS, [
			"island" => $island,
		]);
	}

	public static function favis_ui_main_title() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_MAIN_TITLE, []);
	}

	public static function favis_ui_main_button_addcurrent() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_MAIN_BUTTON_ADDCURRENT, []);
	}

	public static function favis_ui_main_button_addid() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_MAIN_BUTTON_ADDID, []);
	}

	public static function favis_ui_main_button_teleport() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_MAIN_BUTTON_TELEPORT, []);
	}

	public static function favis_ui_main_button_remove() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_MAIN_BUTTON_REMOVE, []);
	}

	public static function favis_ui_addid_title() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_ADDID_TITLE, []);
	}

	public static function favis_ui_addid_input() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_ADDID_INPUT, []);
	}

	public static function favis_ui_teleport_title() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_TELEPORT_TITLE, []);
	}

	public static function favis_ui_remove_title() : Translatable{
		return new Translatable(TranslationKeys::FAVIS_UI_REMOVE_TITLE, []);
	}

	public static function invc_menu_craft6x6() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_CRAFT6X6, []);
	}

	public static function invc_menu_craft3x3() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_CRAFT3X3, []);
	}

	public static function invc_menu_add() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_ADD, []);
	}

	public static function invc_menu_edit() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_EDIT, []);
	}

	public static function invc_menu_save_name() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_SAVE_NAME, []);
	}

	public static function invc_menu_view() : Translatable{
		return new Translatable(TranslationKeys::INVC_MENU_VIEW, []);
	}

	public static function invc_ui_title() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_TITLE, []);
	}

	public static function invc_ui_craft() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_CRAFT, []);
	}

	public static function invc_ui_add() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_ADD, []);
	}

	public static function invc_ui_edit() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_EDIT, []);
	}

	public static function invc_ui_remove() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_REMOVE, []);
	}

	public static function invc_ui_add_input() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_ADD_INPUT, []);
	}

	public static function invc_ui_confirm_title() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_CONFIRM_TITLE, []);
	}

	public static function invc_ui_confirm_content() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_CONFIRM_CONTENT, []);
	}

	public static function invc_ui_confirm_yes() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_CONFIRM_YES, []);
	}

	public static function invc_ui_confirm_no() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_CONFIRM_NO, []);
	}

	public static function invc_ui_3x3recipe() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_3X3RECIPE, []);
	}

	public static function invc_ui_6x6recipe() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_6X6RECIPE, []);
	}

	public static function invc_ui_list() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_LIST, []);
	}

	public static function invc_ui_title_player() : Translatable{
		return new Translatable(TranslationKeys::INVC_UI_TITLE_PLAYER, []);
	}

	public static function invc_msg_invalidname() : Translatable{
		return new Translatable(TranslationKeys::INVC_MSG_INVALIDNAME, []);
	}

	public static function invc_msg_existrecipe() : Translatable{
		return new Translatable(TranslationKeys::INVC_MSG_EXISTRECIPE, []);
	}

	public static function invc_msg_norecipe() : Translatable{
		return new Translatable(TranslationKeys::INVC_MSG_NORECIPE, []);
	}

	public static function invc_msg_missresult() : Translatable{
		return new Translatable(TranslationKeys::INVC_MSG_MISSRESULT, []);
	}

	public static function invc_msg_sametyperecipe() : Translatable{
		return new Translatable(TranslationKeys::INVC_MSG_SAMETYPERECIPE, []);
	}

	public static function invc_command_missrecipename() : Translatable{
		return new Translatable(TranslationKeys::INVC_COMMAND_MISSRECIPENAME, []);
	}

	public static function invc_command_recipenotfound() : Translatable{
		return new Translatable(TranslationKeys::INVC_COMMAND_RECIPENOTFOUND, []);
	}

	public static function mail_nothaverecieved() : Translatable{
		return new Translatable(TranslationKeys::MAIL_NOTHAVERECIEVED, []);
	}

	public static function mail_nothavesent() : Translatable{
		return new Translatable(TranslationKeys::MAIL_NOTHAVESENT, []);
	}

	public static function mail_create_success() : Translatable{
		return new Translatable(TranslationKeys::MAIL_CREATE_SUCCESS, []);
	}

	public static function mail_claim_fail_notreceiver() : Translatable{
		return new Translatable(TranslationKeys::MAIL_CLAIM_FAIL_NOTRECEIVER, []);
	}

	public static function mail_claim_fail_notenoughspace() : Translatable{
		return new Translatable(TranslationKeys::MAIL_CLAIM_FAIL_NOTENOUGHSPACE, []);
	}

	public static function mail_claim_fail_already() : Translatable{
		return new Translatable(TranslationKeys::MAIL_CLAIM_FAIL_ALREADY, []);
	}

	public static function mail_toask_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_TOASK_TITLE, []);
	}

	public static function mail_toask_new(Translatable|string $sender) : Translatable{
		return new Translatable(TranslationKeys::MAIL_TOASK_NEW, [
			"sender" => $sender,
		]);
	}

	public static function mail_toask_unread(Translatable|string $unread) : Translatable{
		return new Translatable(TranslationKeys::MAIL_TOASK_UNREAD, [
			"unread" => $unread,
		]);
	}

	public static function mail_gui_attachitems_name() : Translatable{
		return new Translatable(TranslationKeys::MAIL_GUI_ATTACHITEMS_NAME, []);
	}

	public static function mail_ui_main_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MAIN_TITLE, []);
	}

	public static function mail_ui_main_content(Translatable|string $username) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MAIN_CONTENT, [
			"username" => $username,
		]);
	}

	public static function mail_ui_main_button_create() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MAIN_BUTTON_CREATE, []);
	}

	public static function mail_ui_main_button_sent() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MAIN_BUTTON_SENT, []);
	}

	public static function mail_ui_main_button_mymails() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MAIN_BUTTON_MYMAILS, []);
	}

	public static function mail_ui_create_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_TITLE, []);
	}

	public static function mail_ui_create_input_to() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_INPUT_TO, []);
	}

	public static function mail_ui_create_input_title_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_INPUT_TITLE_TITLE, []);
	}

	public static function mail_ui_create_input_title_placeholder() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_INPUT_TITLE_PLACEHOLDER, []);
	}

	public static function mail_ui_create_input_message_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_INPUT_MESSAGE_TITLE, []);
	}

	public static function mail_ui_create_input_message_placeholder() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_INPUT_MESSAGE_PLACEHOLDER, []);
	}

	public static function mail_ui_create_toggle_attachitems() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_CREATE_TOGGLE_ATTACHITEMS, []);
	}

	public static function mail_ui_sent_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_SENT_TITLE, []);
	}

	public static function mail_ui_sent_button(Translatable|string $title, Translatable|string $to) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_SENT_BUTTON, [
			"title" => $title,
			"to" => $to,
		]);
	}

	public static function mail_ui_mymails_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MYMAILS_TITLE, []);
	}

	public static function mail_ui_mymails_button(Translatable|string $title, Translatable|string $from) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MYMAILS_BUTTON, [
			"title" => $title,
			"from" => $from,
		]);
	}

	public static function mail_ui_mymails_button_new(Translatable|string $title, Translatable|string $from) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_MYMAILS_BUTTON_NEW, [
			"title" => $title,
			"from" => $from,
		]);
	}

	public static function mail_ui_info_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_TITLE, []);
	}

	public static function mail_ui_info_content_id(Translatable|string $id) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_ID, [
			"id" => $id,
		]);
	}

	public static function mail_ui_info_content_from(Translatable|string $from) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_FROM, [
			"from" => $from,
		]);
	}

	public static function mail_ui_info_content_to(Translatable|string $to) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_TO, [
			"to" => $to,
		]);
	}

	public static function mail_ui_info_content_title(Translatable|string $title) : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_TITLE, [
			"title" => $title,
		]);
	}

	public static function mail_ui_info_content_message() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_MESSAGE, []);
	}

	public static function mail_ui_info_content_attachments() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_ATTACHMENTS, []);
	}

	public static function mail_ui_info_content_noneattachment() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_CONTENT_NONEATTACHMENT, []);
	}

	public static function mail_ui_info_button_delete() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_BUTTON_DELETE, []);
	}

	public static function mail_ui_info_button_reply() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_BUTTON_REPLY, []);
	}

	public static function mail_ui_info_button_claim() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_INFO_BUTTON_CLAIM, []);
	}

	public static function mail_ui_delete_title() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_DELETE_TITLE, []);
	}

	public static function mail_ui_delete_content_claimed() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_DELETE_CONTENT_CLAIMED, []);
	}

	public static function mail_ui_delete_content_unclaimed() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_DELETE_CONTENT_UNCLAIMED, []);
	}

	public static function mail_ui_delete_button_yes() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_DELETE_BUTTON_YES, []);
	}

	public static function mail_ui_delete_button_no() : Translatable{
		return new Translatable(TranslationKeys::MAIL_UI_DELETE_BUTTON_NO, []);
	}

	public static function filang_ui_title() : Translatable{
		return new Translatable(TranslationKeys::FILANG_UI_TITLE, []);
	}

	public static function filang_ui_content() : Translatable{
		return new Translatable(TranslationKeys::FILANG_UI_CONTENT, []);
	}

	public static function filang_languagechange() : Translatable{
		return new Translatable(TranslationKeys::FILANG_LANGUAGECHANGE, []);
	}

}
