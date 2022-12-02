<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\GameMenu;

use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use MyPlot\MyPlot;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\Position;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class IslandManager{
	public function __construct(Player $player){
		$this->execute($player);
	}

	public function execute(Player $player) : void{
		$form = new SimpleForm(function(Player $player, $data){
			switch($data){
				case 1:
					$this->AddHelperForm($player);
					break;
				case 2:
					$this->RemoveHelperForm($player);
					break;
				case 3:
					$this->ReNameForm($player);
					break;
				case 4:
					$this->ChangeBiomeForm($player);
					break;
				case 5:
					Server::getInstance()->dispatchCommand($player, "is pvp");
					break;
			}
		});
		$form->setTitle(Lang::translate($player, TF::gh_islandmanager_ui_title()));

		$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_exit()));
		$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_addhelper()));
		$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_removehelper()));
		$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_rename()));
		$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_changebiome()));
		$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
		if($plot->pvp){
			$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_disablepvp()));
		}else{
			$form->addButton(Lang::translate($player, TF::gh_islandmanager_ui_button_enablepvp()));
		}

		$player->sendForm($form);
	}

	public function AddHelperForm(Player $player) : void{
		$players = ["<None>"];
		foreach(Server::getInstance()->getOnlinePlayers() as $p){
			$players[] = $p->getName();
		}

		$form = new CustomForm(function(Player $player, $data) use ($players){
			if(!isset($data[0])) return;
			$pname = $players[$data[0]];
			if($pname == "<None>"){
				return;
			}
			Server::getInstance()->dispatchCommand($player, "is addhelper " . $pname);
		});
		$form->setTitle(Lang::translate($player, TF::gh_islandmanager_addhelper_ui_title()));
		$form->addDropdown(Lang::translate($player, TF::gh_islandmanager_addhelper_ui_input()), $players);
		$player->sendForm($form);
	}

	public function RemoveHelperForm(Player $player) : void{
		$pos = new Position($player->getPosition()->getX(), $player->getPosition()->getZ(), $player->getPosition()->getZ(), $player->getWorld());
		$plot = MyPlot::getInstance()->getPlotByPosition($pos);
		if($plot == null){
			$player->sendMessage(Lang::translate($player, TF::gh_invalidisland()));
			return;
		}
		$helpers = ["<None>"];
		foreach($plot->helpers as $h){
			$helpers[] = $h;
		}
		$form = new CustomForm(function(Player $player, $data) use ($helpers){
			if(!isset($data[0])) return;
			$pname = $helpers[$data[0]];
			if($pname == "<None>"){
				return;
			}
			Server::getInstance()->dispatchCommand($player, "is removehelper " . $pname);
		});
		$form->setTitle(Lang::translate($player, TF::gh_islandmanager_removehelper_ui_title()));
		$form->addDropdown(Lang::translate($player, TF::gh_islandmanager_removehelper_ui_dropdown()), $helpers);
		$player->sendForm($form);
	}

	public function ReNameForm(Player $player) : void{
		$form = new CustomForm(function(Player $player, $data){
			if(!isset($data[0])) return;

			$plot = MyPlot::getInstance()->getPlotByPosition($player->getPosition());
			if(($player->getName() == $plot->owner) or Server::getInstance()->isOp($player->getName())){
				$plot->name = $data[0];
				$player->sendMessage(Lang::translate($player, TF::gh_islandmanager_rename_success()));
			}else{
				$player->sendMessage(Lang::translate($player, TF::gh_islandmanager_rename_noperm()));
			}
		});

		$form->setTitle(Lang::translate($player, TF::gh_islandmanager_rename_ui_title()));
		$form->addInput(Lang::translate($player, TF::gh_islandmanager_rename_ui_input_text()), Lang::translate($player, TF::gh_islandmanager_rename_ui_input_placeholder()));
		$player->sendForm($form);
	}

	public function ChangeBiomeForm(Player $player) : void{
		$arr = ["<none>", "PLAINS", "DESERT", "MOUNTAINS", "FOREST", "TAIGA", "SWAMP", "NETHER", "HELL", "ICE_PLAINS"];
		$form = new CustomForm(function(Player $player, $data){
			if(!isset($data[0])) return;
			if($data[0] == "<none>") return;
			Server::getInstance()->dispatchCommand($player, "is biome " . $data[0]);
		});
		$form->addDropdown(Lang::translate($player, TF::gh_islandmanager_changebiome_ui_dropdown()), $arr);
		$form->setTitle(Lang::translate($player, TF::gh_islandmanager_changebiome_ui_title()));
		$player->sendForm($form);
	}
}
