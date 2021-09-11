<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class TeleportManager{
	public function __construct(Player $player){
		$this->execute($player);
	}

	public function execute(Player $player){
		$console = new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage());

		$form = new SimpleForm(function(Player $player, $data) use ($console){
			if($data == 0) return;
			switch($data){
				case 1:
					$this->SpecialIslandForm($player);
					break;
				case 2:
					if($player->getWorld()->getDisplayName() !== "island")
						Server::getInstance()->dispatchCommand($console, "mw tp island " . $player->getName());
					Server::getInstance()->dispatchCommand($player, "is home");
					break;
				case 3:
					$this->WarpForm($player);
					break;
				case 4:
					Server::getInstance()->dispatchCommand($console, "mw tp afk " . $player->getName());
					break;
				case 5:
					Server::getInstance()->dispatchCommand($console, "mw tp mine " . $player->getName());
					break;
			}
		});
		$form->setTitle("Teleport");
		$form->addButton("§　§l§cEXIT");
		$form->addButton("§　§lSpecial Island");
		$form->addButton("§lMy Island\nVề đảo của bạn");
		$form->addButton("§lGo to another island\nDịch chuyển sang đảo khác");
		$form->addButton("§lAfk Area\nKhu vực afk");
		$form->addButton("§　§lMine Area\nKhu mine");

		$player->sendForm($form);
	}

	public function SpecialIslandForm(Player $player){
		$form = new SimpleForm(function(Player $player, $data){
			switch($data){
				case 1:
					Server::getInstance()->dispatchCommand($player, "is warp -4;1");
					break;
				case 2:
					Server::getInstance()->dispatchCommand($player, "is warp 0;0");
					break;
			}
		});
		$form->addButton("§　§eEXIT");
		$form->addButton("§The Sea Island\nBy PikarioVN");
		$form->addButton("§　§lThe Ultra Farmland");

		$form->setTitle("§　§lSpecial Island");

		$player->sendForm($form);
	}

	public function WarpForm(Player $player){
		$form = new CustomForm(function(Player $player, $data){
			if(!isset($data[0])) return;
			Server::getInstance()->dispatchCommand($player, "is warp " . $data[0]);
		});
		$form->setTitle("§　§lGo to another island");
		$form->addInput("§　Island ID (X;Z)", "1;2");
		$player->sendForm($form);
	}
}
