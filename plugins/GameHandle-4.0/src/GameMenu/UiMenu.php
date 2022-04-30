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
		if(MyPlot::getInstance()->isLevelLoaded($player->getWorld()->getDisplayName())){
			$list[] = "is-manager";
			$list[] = "is-info";
			$list[] = "favorite-island";
		}
		$list[] = "teleport";
		$list[] = "shop";
		$list[] = "sell-all";
		$list[] = "tutorial";
		$list[] = "invcraft";
		$list[] = "backpack";
		$list[] = "mail";
		$list[] = "bank";
		$list[] = "bazaar";

		$form = new SimpleForm(function(Player $player, $data) use ($list) : void{
			if(!isset($data)){
				return;
			}
			switch($list[$data]){
				case "is-manager":
					new IslandManager($player);
					break;
				case "favorite-island":
					Server::getInstance()->dispatchCommand($player, "favislands");
					break;
				case "teleport":
					new TeleportManager($player);
					break;
				case "shop":
					Server::getInstance()->dispatchCommand($player, "shop");
					break;
				case "sell-all":
					Server::getInstance()->dispatchCommand($player, "sell all");
					break;
				case "is-info":
					$this->IslandInfoForm($player);
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
		if(MyPlot::getInstance()->isLevelLoaded($player->getWorld()->getDisplayName())){
			$form->addButton("§　§lIsland Manager\nQuản lý đảo");
			$form->addButton("§　§lIsland Info\nThông tin đảo");
			$form->addButton("§　§lFavorite Islands");
		}
		$form->addButton("§lFast Travel\nDịch chuyển nhanh");
		$form->addButton("§　§lShop");
		$form->addButton("§lSell All Inventory\nBán toàn bộ vật phẩm");
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
		$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
		if($plot == null){
			$player->sendMessage("Failed to get island info.");
			return;
		}
		$form = new CustomForm(function(Player $player, $data){ });
		$form->setTitle("§　§lIsland Info");
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