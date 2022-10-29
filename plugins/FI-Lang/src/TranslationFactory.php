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

	public static function gh_season_spring() : Translatable{
		return new Translatable(TranslationKeys::GH_SEASON_SPRING, []);
	}

	public static function gh_season_summer() : Translatable{
		return new Translatable(TranslationKeys::GH_SEASON_SUMMER, []);
	}

	public static function gh_season_autumn() : Translatable{
		return new Translatable(TranslationKeys::GH_SEASON_AUTUMN, []);
	}

	public static function gh_season_winter() : Translatable{
		return new Translatable(TranslationKeys::GH_SEASON_WINTER, []);
	}

	public static function gh_afkreward() : Translatable{
		return new Translatable(TranslationKeys::GH_AFKREWARD, []);
	}

	public static function gh_sell_cantbesold() : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_CANTBESOLD, []);
	}

	public static function gh_sell_sold(Translatable|string $count, Translatable|string $price, Translatable|string $buff) : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_SOLD, [
			"count" => $count,
			"price" => $price,
			"buff" => $buff,
		]);
	}

	public static function gh_sell_undo_fail_none() : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_UNDO_FAIL_NONE, []);
	}

	public static function gh_sell_undo_fail_notenoughmoney() : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_UNDO_FAIL_NOTENOUGHMONEY, []);
	}

	public static function gh_sell_undo_fail_notenoughspace() : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_UNDO_FAIL_NOTENOUGHSPACE, []);
	}

	public static function gh_sell_undo_success() : Translatable{
		return new Translatable(TranslationKeys::GH_SELL_UNDO_SUCCESS, []);
	}

	public static function gh_startgame() : Translatable{
		return new Translatable(TranslationKeys::GH_STARTGAME, []);
	}

	public static function gh_notp() : Translatable{
		return new Translatable(TranslationKeys::GH_NOTP, []);
	}

	public static function gh_died(Translatable|string $coins) : Translatable{
		return new Translatable(TranslationKeys::GH_DIED, [
			"coins" => $coins,
		]);
	}

	public static function gh_notinisland() : Translatable{
		return new Translatable(TranslationKeys::GH_NOTINISLAND, []);
	}

	public static function gh_invalidisland() : Translatable{
		return new Translatable(TranslationKeys::GH_INVALIDISLAND, []);
	}

	public static function gh_cmd_playernotfound() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PLAYERNOTFOUND, []);
	}

	public static function gh_cmd_cgive_fail_unknowid() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_CGIVE_FAIL_UNKNOWID, []);
	}

	public static function gh_cmd_cgive_fail_notenoughspace() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_CGIVE_FAIL_NOTENOUGHSPACE, []);
	}

	public static function gh_cmd_cgive_fail_decode() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_CGIVE_FAIL_DECODE, []);
	}

	public static function gh_cmd_cgive_success() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_CGIVE_SUCCESS, []);
	}

	public static function gh_cmd_dupe_fail_none() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_DUPE_FAIL_NONE, []);
	}

	public static function gh_cmd_dupe_fail_invfull() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_DUPE_FAIL_INVFULL, []);
	}

	public static function gh_cmd_dupe_success() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_DUPE_SUCCESS, []);
	}

	public static function gh_cmd_feed_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FEED_OTHER_NOPERM, []);
	}

	public static function gh_cmd_feed_other_success(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FEED_OTHER_SUCCESS, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_feed_success() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FEED_SUCCESS, []);
	}

	public static function gh_cmd_fiver_server(Translatable|string $version, Translatable|string $codeName) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FIVER_SERVER, [
			"version" => $version,
			"codeName" => $codeName,
		]);
	}

	public static function gh_cmd_fiver_base(Translatable|string $version) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FIVER_BASE, [
			"version" => $version,
		]);
	}

	public static function gh_cmd_fly_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FLY_OTHER_NOPERM, []);
	}

	public static function gh_cmd_fly_other_enable(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FLY_OTHER_ENABLE, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_fly_other_disable(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FLY_OTHER_DISABLE, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_fly_enable() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FLY_ENABLE, []);
	}

	public static function gh_cmd_fly_disable() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FLY_DISABLE, []);
	}

	public static function gh_cmd_freeze_success(Translatable|string $target, Translatable|string $time) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FREEZE_SUCCESS, [
			"target" => $target,
			"time" => $time,
		]);
	}

	public static function gh_cmd_freeze_targetnotice(Translatable|string $time) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_FREEZE_TARGETNOTICE, [
			"time" => $time,
		]);
	}

	public static function gh_cmd_unfreeze_success(Translatable|string $target) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_UNFREEZE_SUCCESS, [
			"target" => $target,
		]);
	}

	public static function gh_cmd_unfreeze_targetnotice() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_UNFREEZE_TARGETNOTICE, []);
	}

	public static function gh_cmd_gamemode_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_GAMEMODE_OTHER_NOPERM, []);
	}

	public static function gh_cmd_gamemode_other_success(Translatable|string $player, Translatable|string $gamemode) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_GAMEMODE_OTHER_SUCCESS, [
			"player" => $player,
			"gamemode" => $gamemode,
		]);
	}

	public static function gh_cmd_gamemode_success(Translatable|string $gamemode) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_GAMEMODE_SUCCESS, [
			"gamemode" => $gamemode,
		]);
	}

	public static function gh_cmd_gamemode_addname() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_GAMEMODE_ADDNAME, []);
	}

	public static function gh_cmd_haste_invalidlevel() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_INVALIDLEVEL, []);
	}

	public static function gh_cmd_haste_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_OTHER_NOPERM, []);
	}

	public static function gh_cmd_haste_other_enable(Translatable|string $level, Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_OTHER_ENABLE, [
			"level" => $level,
			"player" => $player,
		]);
	}

	public static function gh_cmd_haste_other_disable(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_OTHER_DISABLE, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_haste_success(Translatable|string $level) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_SUCCESS, [
			"level" => $level,
		]);
	}

	public static function gh_cmd_haste_disable() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HASTE_DISABLE, []);
	}

	public static function gh_cmd_heal_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HEAL_OTHER_NOPERM, []);
	}

	public static function gh_cmd_heal_other_success(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HEAL_OTHER_SUCCESS, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_heal_success() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_HEAL_SUCCESS, []);
	}

	public static function gh_cmd_mute_success(Translatable|string $target, Translatable|string $time) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_MUTE_SUCCESS, [
			"target" => $target,
			"time" => $time,
		]);
	}

	public static function gh_cmd_mute_targetnotice(Translatable|string $time) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_MUTE_TARGETNOTICE, [
			"time" => $time,
		]);
	}

	public static function gh_cmd_unmute_success(Translatable|string $target) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_UNMUTE_SUCCESS, [
			"target" => $target,
		]);
	}

	public static function gh_cmd_unmute_targetnotice() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_UNMUTE_TARGETNOTICE, []);
	}

	public static function gh_cmd_notp_enable() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_NOTP_ENABLE, []);
	}

	public static function gh_cmd_notp_disable() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_NOTP_DISABLE, []);
	}

	public static function gh_cmd_pinfo_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_OTHER_NOPERM, []);
	}

	public static function gh_cmd_pinfo_info1(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO1, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_pinfo_info2(Translatable|string $x, Translatable|string $y, Translatable|string $z) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO2, [
			"x" => $x,
			"y" => $y,
			"z" => $z,
		]);
	}

	public static function gh_cmd_pinfo_info3(Translatable|string $world) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO3, [
			"world" => $world,
		]);
	}

	public static function gh_cmd_pinfo_info4(Translatable|string $realname) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO4, [
			"realname" => $realname,
		]);
	}

	public static function gh_cmd_pinfo_info5(Translatable|string $ip) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO5, [
			"ip" => $ip,
		]);
	}

	public static function gh_cmd_pinfo_info6(Translatable|string $port) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO6, [
			"port" => $port,
		]);
	}

	public static function gh_cmd_pinfo_info7(Translatable|string $ping) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO7, [
			"ping" => $ping,
		]);
	}

	public static function gh_cmd_pinfo_info8(Translatable|string $locate) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO8, [
			"locate" => $locate,
		]);
	}

	public static function gh_cmd_pinfo_info9(Translatable|string $uuid) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO9, [
			"uuid" => $uuid,
		]);
	}

	public static function gh_cmd_pinfo_info10(Translatable|string $xuid) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_PINFO_INFO10, [
			"xuid" => $xuid,
		]);
	}

	public static function gh_cmd_size_other_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_SIZE_OTHER_NOPERM, []);
	}

	public static function gh_cmd_size_other_success(Translatable|string $player, Translatable|string $size) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_SIZE_OTHER_SUCCESS, [
			"player" => $player,
			"size" => $size,
		]);
	}

	public static function gh_cmd_size_success(Translatable|string $size) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_SIZE_SUCCESS, [
			"size" => $size,
		]);
	}

	public static function gh_cmd_size_toosmall(Translatable|string $minSize) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_SIZE_TOOSMALL, [
			"minSize" => $minSize,
		]);
	}

	public static function gh_cmd_size_toolarge(Translatable|string $maxSize) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_SIZE_TOOLARGE, [
			"maxSize" => $maxSize,
		]);
	}

	public static function gh_cmd_tpall_other(Translatable|string $player) : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_TPALL_OTHER, [
			"player" => $player,
		]);
	}

	public static function gh_cmd_tpall_self() : Translatable{
		return new Translatable(TranslationKeys::GH_CMD_TPALL_SELF, []);
	}

	public static function gh_menu_item_name() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_ITEM_NAME, []);
	}

	public static function gh_menu_item_lore() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_ITEM_LORE, []);
	}

	public static function gh_menu_main_title() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_TITLE, []);
	}

	public static function gh_menu_main_button_islandinfo() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_ISLANDINFO, []);
	}

	public static function gh_menu_main_button_islandmanager() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_ISLANDMANAGER, []);
	}

	public static function gh_menu_main_button_favisland() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_FAVISLAND, []);
	}

	public static function gh_menu_main_button_fasttravel() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_FASTTRAVEL, []);
	}

	public static function gh_menu_main_button_shop() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_SHOP, []);
	}

	public static function gh_menu_main_button_tutorial() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_TUTORIAL, []);
	}

	public static function gh_menu_main_button_invcraft() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_INVCRAFT, []);
	}

	public static function gh_menu_main_button_backpack() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_BACKPACK, []);
	}

	public static function gh_menu_main_button_bazaar() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_BAZAAR, []);
	}

	public static function gh_menu_main_button_mail() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_MAIL, []);
	}

	public static function gh_menu_main_button_bank() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_BANK, []);
	}

	public static function gh_menu_main_button_about() : Translatable{
		return new Translatable(TranslationKeys::GH_MENU_MAIN_BUTTON_ABOUT, []);
	}

	public static function gh_fasttravel_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_FASTTRAVEL_UI_TITLE, []);
	}

	public static function gh_updateinfo_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_TITLE, []);
	}

	public static function gh_updateinfo_ui_content_wiki() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_CONTENT_WIKI, []);
	}

	public static function gh_updateinfo_ui_content_vote() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_CONTENT_VOTE, []);
	}

	public static function gh_updateinfo_ui_content_fbgroup() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_CONTENT_FBGROUP, []);
	}

	public static function gh_updateinfo_ui_content_version(Translatable|string $version, Translatable|string $codeName) : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_CONTENT_VERSION, [
			"version" => $version,
			"codeName" => $codeName,
		]);
	}

	public static function gh_updateinfo_ui_button_close() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_BUTTON_CLOSE, []);
	}

	public static function gh_updateinfo_ui_button_tutorial() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_UI_BUTTON_TUTORIAL, []);
	}

	public static function gh_updateinfo_tutorial_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_TUTORIAL_UI_TITLE, []);
	}

	public static function gh_updateinfo_tutorial_ui_content() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_TUTORIAL_UI_CONTENT, []);
	}

	public static function gh_updateinfo_tutorial_ui_button_close() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_TUTORIAL_UI_BUTTON_CLOSE, []);
	}

	public static function gh_updateinfo_warning_title() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_WARNING_TITLE, []);
	}

	public static function gh_updateinfo_warning_content() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_WARNING_CONTENT, []);
	}

	public static function gh_updateinfo_warning_button_close() : Translatable{
		return new Translatable(TranslationKeys::GH_UPDATEINFO_WARNING_BUTTON_CLOSE, []);
	}

	public static function gh_islandinfo_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDINFO_UI_TITLE, []);
	}

	public static function gh_islandinfo_id(Translatable|string $x) : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDINFO_ID, [
			"x" => $x,
		]);
	}

	public static function gh_islandinfo_owner(Translatable|string $owner) : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDINFO_OWNER, [
			"owner" => $owner,
		]);
	}

	public static function gh_islandinfo_name(Translatable|string $name) : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDINFO_NAME, [
			"name" => $name,
		]);
	}

	public static function gh_islandinfo_member(Translatable|string $member) : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDINFO_MEMBER, [
			"member" => $member,
		]);
	}

	public static function gh_islandmanager_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_TITLE, []);
	}

	public static function gh_islandmanager_ui_button_addhelper() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_ADDHELPER, []);
	}

	public static function gh_islandmanager_ui_button_removehelper() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_REMOVEHELPER, []);
	}

	public static function gh_islandmanager_ui_button_rename() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_RENAME, []);
	}

	public static function gh_islandmanager_ui_button_changebiome() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_CHANGEBIOME, []);
	}

	public static function gh_islandmanager_ui_button_enablepvp() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_ENABLEPVP, []);
	}

	public static function gh_islandmanager_ui_button_disablepvp() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_UI_BUTTON_DISABLEPVP, []);
	}

	public static function gh_islandmanager_addhelper_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_ADDHELPER_UI_TITLE, []);
	}

	public static function gh_islandmanager_addhelper_ui_input() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_ADDHELPER_UI_INPUT, []);
	}

	public static function gh_islandmanager_removehelper_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_REMOVEHELPER_UI_TITLE, []);
	}

	public static function gh_islandmanager_removehelper_ui_dropdown() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_REMOVEHELPER_UI_DROPDOWN, []);
	}

	public static function gh_islandmanager_rename_noperm() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_RENAME_NOPERM, []);
	}

	public static function gh_islandmanager_rename_success() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_RENAME_SUCCESS, []);
	}

	public static function gh_islandmanager_rename_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_RENAME_UI_TITLE, []);
	}

	public static function gh_islandmanager_rename_ui_input_text() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_RENAME_UI_INPUT_TEXT, []);
	}

	public static function gh_islandmanager_rename_ui_input_placeholder() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_RENAME_UI_INPUT_PLACEHOLDER, []);
	}

	public static function gh_islandmanager_changebiome_ui_title() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_CHANGEBIOME_UI_TITLE, []);
	}

	public static function gh_islandmanager_changebiome_ui_dropdown() : Translatable{
		return new Translatable(TranslationKeys::GH_ISLANDMANAGER_CHANGEBIOME_UI_DROPDOWN, []);
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
