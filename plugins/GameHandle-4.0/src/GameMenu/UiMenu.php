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

	public function MenuForm(Player $player) : void{
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
		$list[] = "about";

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
				case "about":
					$this->About($player);
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
		$form->addButton("§　§lAbout FarmingIsland");
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

	public function IslandInfoForm(Player $player) : void{
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

	public function About(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if (is_null($data)){
				return;
			}
			if ($data == 0){
				$this->Credits($player);
			}
		});
		$form->setTitle("§　§l§eAbout FarmingIsland");
		$text = [
			"Version: " . Core::VERSION,
			"Developer: JinodkDevTeam",
			"Github: github.com/JinodkDevTeam",
			"",
			"FarmingIsland là một chế độ mới được phát triển bởi JinodkDevTeam.",
			"Hướng đến lối chơi nhẹ nhàng, chill khi bạn được quyết định cách bạn trải nghiệm chế độ này.",
			"Tất nhiên là server sẽ không có bất cứ hình thức Pay to win nào cả nhằm đảm bảo cân bằng cho tất cả các người chơi.",
			"",
			"Nếu bạn thấy server hay, hãy ủng hộ team của bọn mình để chế độ này có thể phát triển nhiều hơn nữa :>",
			"",
			"Thanks for your support!",
		];
		$form->setContent(implode("\n", $text));
		$form->addButton("§　§lCredits");
		$player->sendForm($form);
	}

	public function Credits(Player $player) : void{
		$form = new CustomForm(function(Player $player, ?array $data){
			//NOOP
		});
		$form->setTitle("§　§lCredits");
		$form->addLabel("§　--Staffs|JinodkDevTeam--");
		$form->addLabel("§　JINODK - Host");
		$form->addLabel("§　NgLam - Developer, Gameplay Designer");
		$form->addLabel("§　");
		$form->addLabel("§　--SPECIAL THANKS TO--");
		$form->addLabel("§　Campiole - Tester");
		$form->addLabel("§　PikarioVN - Tester");
		$form->addLabel("§　EggyUnicycle766 - Tester");
		$form->addLabel("§　HKYT19 - Youtuber");

		$player->sendForm($form);
	}
}