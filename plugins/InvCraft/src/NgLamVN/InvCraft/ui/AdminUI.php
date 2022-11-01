<?php
declare(strict_types=1);

namespace NgLamVN\InvCraft\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use jojoe77777\FormAPI\SimpleForm;
use NgLamVN\InvCraft\Loader;
use NgLamVN\InvCraft\menu\AddRecipeMenu;
use NgLamVN\InvCraft\menu\CraftMenu;
use NgLamVN\InvCraft\menu\EditRecipeMenu;
use NgLamVN\InvCraft\menu\ViewRecipe;
use NgLamVN\InvCraft\Recipe;
use pocketmine\player\Player;
use pocketmine\Server;

class AdminUI{
	public function __construct(Player $player){
		$this->form($player);
	}

	public function form(Player $player) : void{
		$form = new SimpleForm(function(Player $player, $data){
			if(!isset($data)){
				return;
			}
			switch($data){
				case 0:
					new CraftMenu($player, $this->getLoader(), Recipe::VIxVI_MODE);
					return;
				case 1:
					new CraftMenu($player, $this->getLoader(), Recipe::IIIxIII_MODE);
					return;
				case 2:
					$this->addRecipe($player);
					break;
				case 3:
					$this->editRecipe($player);
					break;
				case 4:
					$this->removeRecipe($player);
					break;
				case 5:
					$this->viewRecipe($player);
					break;
			}
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_title()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_6x6recipe()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_3x3recipe()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_add()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_edit()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_remove()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_list()));

		$player->sendForm($form);
	}

	/**
	 * @return Loader|null
	 */
	public function getLoader() : ?Loader{
		$loader = Server::getInstance()->getPluginManager()->getPlugin("InvCraft");
		if($loader instanceof Loader){
			return $loader;
		}
		return null;
	}

	public function addRecipe(Player $player) : void{
		$form = new CustomForm(function(Player $player, $data){
			if(!isset($data[0])){
				return;
			}
			if(!isset($data[1])){
				return;
			}
			if(($data[0] == "") or ($data[0] == " ")){
				$player->sendMessage(FILang::translate($player, TranslationFactory::invc_msg_invalidname()));
				return;
			}
			$mode = Recipe::VIxVI_MODE;
			if($data[1] == 1){
				$mode = Recipe::IIIxIII_MODE;
			}
			foreach($this->getLoader()->getRecipes() as $recipe){
				if($recipe->getRecipeName() == $data[0]){
					$player->sendMessage(FILang::translate($player, TranslationFactory::invc_msg_existrecipe()));
					return;
				}
			}
			new AddRecipeMenu($player, $this->getLoader(), $mode, $data[0]);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_add()));
		$form->addInput(FILang::translate($player, TranslationFactory::invc_ui_add_input()), "ABCabc123");
		$form->addDropdown("Mode", ["6x6", "3x3"]);

		$player->sendForm($form);
	}

	public function editRecipe(Player $player) : void{
		$recipes = [];
		foreach($this->getLoader()->getRecipes() as $recipe){
			$recipes[] = $recipe;
		}

		if($recipes == []){
			$player->sendMessage(FILang::translate($player, TranslationFactory::invc_msg_norecipe()));
			return;
		}

		$form = new SimpleForm(function(Player $player, $data) use ($recipes){
			if(!isset($data)){
				return;
			}
			new EditRecipeMenu($player, $this->getLoader(), $recipes[$data]);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_edit()));
		foreach($this->getLoader()->getRecipes() as $recipe){
			$form->addButton($recipe->getRecipeName());
		}

		$player->sendForm($form);
	}

	public function removeRecipe(Player $player) : void{
		$recipes = [];
		foreach($this->getLoader()->getRecipes() as $recipe){
			$recipes[] = $recipe;
		}

		if($recipes == []){
			$player->sendMessage(FILang::translate($player, TranslationFactory::invc_msg_norecipe()));
			return;
		}

		$form = new SimpleForm(function(Player $player, $data) use ($recipes){
			if(!isset($data)){
				return;
			}
			$re = $recipes[$data];

			$confirm = new ModalForm(function(Player $player, $data2) use ($re){
				if(!isset($data2)){
					return;
				}
				if($data2){
					$this->getLoader()->removeRecipe($re);
				}
			});

			$confirm->setTitle(FILang::translate($player, TranslationFactory::invc_ui_confirm_title()));
			$confirm->setButton1(FILang::translate($player, TranslationFactory::invc_ui_confirm_yes()));
			$confirm->setButton2(FILang::translate($player, TranslationFactory::invc_ui_confirm_no()));
			$confirm->setContent(FILang::translate($player, TranslationFactory::invc_ui_confirm_content()));

			$player->sendForm($confirm);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_remove()));
		foreach($this->getLoader()->getRecipes() as $recipe){
			$form->addButton($recipe->getRecipeName());
		}

		$player->sendForm($form);
	}

	public function viewRecipe(Player $player) : void{
		$recipes = [];
		foreach($this->getLoader()->getRecipes() as $recipe){
			$recipes[] = $recipe;
		}

		if($recipes == []){
			$player->sendMessage(FILang::translate($player, TranslationFactory::invc_msg_norecipe()));
			return;
		}

		$form = new SimpleForm(function(Player $player, $data) use ($recipes){
			if(!isset($data)){
				return;
			}
			new ViewRecipe($player, $this->getLoader(), $recipes[$data]);
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_list()));
		foreach($this->getLoader()->getRecipes() as $recipe){
			$form->addButton($recipe->getRecipeName());
		}

		$player->sendForm($form);
	}
}
