<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\Core;
use pocketmine\player\Player;
use pocketmine\Server;

class UiMenu{
	public function __construct(Player $player){
		$this->MenuForm($player);
	}

	public function MenuForm(Player $player){
		$list = [];
		if($player->getWorld()->getDisplayName() == "island"){
			array_push($list, "is-manager");
			array_push($list, "is-info");
			array_push($list, "favorite-island");
		}
		array_push($list, "teleport");
		array_push($list, "shop");
		array_push($list, "vip-shop");
		array_push($list, "sell-all");
		array_push($list, "vip");
		array_push($list, "tutorial");
		array_push($list, "invcraft");
		array_push($list, "backpack");
		array_push($list, "mail");
		array_push($list, "bank");
		array_push($list, "bazaar");

		$form = new SimpleForm(function(Player $player, $data) use ($list) : void{
			if(!isset($data)){
				return;
			}
			switch($list[$data]){
				case "is-manager":
					/*new IslandManager($player);*/
					break;
				case "teleport":
					/*new TeleportManager($player);*/
					break;
				case "vip":
					/*new VipManager($player);*/
					break;
				case "shop":
					Server::getInstance()->dispatchCommand($player, "shop");
					break;
				case "sell-all":
					Server::getInstance()->dispatchCommand($player, "sell all");
					break;
				case "vip-shop":
					/*Server::getInstance()->dispatchCommand($player, "cuahang");*/
					break;
				case "is-info":
					/*$this->IslandInfoForm($player);*/
					break;
				case "tutorial":
					Server::getInstance()->dispatchCommand($player, "tutorial");
					break;
				case "invcraft":
					Server::getInstance()->dispatchCommand($player, "invcraft");
					break;
				case "backpack":
					Server::getInstance()->dispatchCommand($player, "backpack");
					break;
				case "mail":
					Server::getInstance()->dispatchCommand($player, "mail");
					break;
				case "bank":
					Server::getInstance()->dispatchCommand($player, "bank");
					break;
				case "bazaar":
					Server::getInstance()->dispatchCommand($player, "bazaar");
					break;
			}
		});
		if($player->getWorld()->getDisplayName() == "island"){
			$form->addButton("§　§lIsland Manager(Comming soon)\nQuản lý đảo");
			$form->addButton("§　§lIsland Info(Comming soon)\nThông tin đảo");

		}
		$form->addButton("§lTeleport(Comming soon)\nDịch chuyển");
		$form->addButton("§　§lShop");
		$form->addButton("§　§lVipItem Shop\n(Comming soon)");
		$form->addButton("§lSell All Inventory\nBán toàn bộ vật phẩm");
		$form->addButton("§　§lVIP(Comming soon)");
		$form->addButton("§lTutorial\nXem cách chơi");
		$form->addButton("§lInvCraft\nBàn chế tạo siêu to khổng lồ");
		$form->addButton("§　§lBackpack");
		$form->addButton("§　§lMail");
		$form->addButton("§　§lBank");
		$form->addButton("§　§lBazaar");
		$form->setTitle("§　Island Menu");
		$player->sendForm($form);
	}

	public function getCore() : ?Core{
		$core = Server::getInstance()->getPluginManager()->getPlugin("FI-GameHandle");
		if($core instanceof Core){
			return $core;
		}
		return null;
	}

	public function IslandInfoForm(Player $player){
		$form = new CustomForm(function(Player $player, $data){ });
		$form->setTitle("§　§lIsland Info");
		$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
		$h = "";
		foreach($plot->helpers as $helper){
			if($h == ""){
				$h = $h . "" . $helper;
			}else{
				$h = $h . "," . $helper;
			}
		}
		$form->addLabel("§　Island ID: " . $plot->X . ";" . $plot->Z);
		$form->addLabel("§　Owner: " . $plot->owner);
		$form->addLabel("§　Island Name: " . $plot->name);
		$form->addLabel("§　Helpers: " . $h);

		$player->sendForm($form);
	}
}