<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\Sell;

use NgLamVN\GameHandle\Core;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\Config;
//TODO: Modernize this class aka rewrite
class SellHandler{
	public const GLOBAL_BUFF = 0;
	public const RANK_BUFF = 10;

	public const BUFF_RANK = ["Vip", "VipPlus", "Member", "Youtuber"];

	public Core $core;

	public array $data;

	public Config $cfg;

	public function __construct(Core $core){
		$this->core = $core;
		$this->register();
	}

	public function register() : void{
		$this->getDataConfig();
	}

	public function getDataConfig() : void{
		$this->cfg = new Config($this->getSellDataFolder() . "sell.yml", Config::YAML);
		$this->data = $this->cfg->getAll();
	}

	public function getSellDataFolder() : string{
		$folder = $this->getCore()->getDataFolder() . "Sell/";
		if(!file_exists($folder)){
			@mkdir($folder);
		}
		return $folder;
	}

	public function getCore() : Core{
		return $this->core;
	}

	public function sellHand(Player $player) : void{
		/** @var Item[] $sellitems */
		$sellitems = [];
		$item = $player->getInventory()->getItemInHand();
		$price = $this->toPrice($item);
		if($price < 0){
			$player->sendMessage("Can't sold this item !");
			return;
		}
		if($this->isBuff($player)){
			$buff = self::RANK_BUFF + self::GLOBAL_BUFF;
		}else{
			$buff = self::GLOBAL_BUFF;
		}
		$price += $price * ($buff / 100);

		$sellitems[] = $item;
		$this->addSellUndoAction($player, $price, $sellitems);
		$player->sendMessage("Sold " . $item->getCount() . " items for " . $price . " xu (+" . $buff . " percent)");
		EconomyAPI::getInstance()->addMoney($player, $price);
		$player->getInventory()->remove($item);
	}

	public function toPrice(Item $item) : float{
		$id = $item->getId();
		$meta = $item->getMeta();
		$count = $item->getCount();

		if($meta !== 0){
			$pos = $id . "/" . $meta;
		}else{
			$pos = (string) $id;
		}
		if(!isset($this->data[$pos])){
			return -1;
		}
		return (float) $this->data[$pos] * $count;
	}

	public function isBuff(Player $player) : bool{
		if(in_array($this->getCore()->getPlayerGroupName($player), self::BUFF_RANK)){
			return true;
		}
		return false;
	}

	public function addSellUndoAction(Player $player, float $sellprice = 0, array $sellitems = []) : void{
		$action = new SellUndoAction($player, $sellprice, $sellitems);
		$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setSellUndoAction($action);
	}

	public function sellAll(Player $player) : void{
		/** @var Item[] $sellitems */
		$sellitems = [];
		$inv = $player->getInventory();
		$total = 0;
		$totalcount = 0;

		if($this->isBuff($player)){
			$buff = self::RANK_BUFF + self::GLOBAL_BUFF;
		}else{
			$buff = self::GLOBAL_BUFF;
		}

		foreach($inv->getContents() as $item){
			$price = $this->toPrice($item);
			if($price < 0){
				continue;
			}
			$sellitems[] = $item;
			$price += $price * ($buff / 100);
			$total += $price;
			$totalcount += $item->getCount();
			$inv->remove($item);
		}
		$this->addSellUndoAction($player, $total, $sellitems);
		$player->sendMessage("Sold " . $totalcount . " items for " . $total . " xu (+" . $buff . " percent)");
		EconomyAPI::getInstance()->addMoney($player, $total);
	}

	public function undo(Player $player) : void{
		$action = $this->getCore()->getPlayerStatManager()->getPlayerStat($player)->getSellUndoAction();
		if($action == null){
			$player->sendMessage("You don't have any sell action to undo !");
			return;
		}
		$ecoapi = EconomyAPI::getInstance();
		if($ecoapi->myMoney($player) < $action->getUndoPrice()){
			$player->sendMessage("You don't have enough money to undo your sell action !");
			return;
		}
		$inv = $player->getInventory();
		if($this->getEmptySlotsCount($player) < count($action->getItems())){
			$player->sendMessage("Not enough space to add item back, please have enough space to add items back and /sell undo again !");
			return;
		}
		foreach($action->getItems() as $item){
			$inv->addItem($item);
		}
		$player->sendMessage("Undo sell action successful !");
		$ecoapi->reduceMoney($player, $action->getUndoPrice());
		$this->getCore()->getPlayerStatManager()->getPlayerStat($player)->setSellUndoAction(null);
	}

	public function getEmptySlotsCount(Player $player) : int{
		$count = 0;
		$inv = $player->getInventory();
		for($i = 0; $i < 36; $i++){
			if($inv->isSlotEmpty($i)) $count++;
		}
		return $count;
	}
}