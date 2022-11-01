<?php
declare(strict_types=1);

namespace NgLamVN\InvCraft\ui;

use FILang\FILang;
use FILang\TranslationFactory;
use jojoe77777\FormAPI\SimpleForm;
use NgLamVN\InvCraft\Loader;
use NgLamVN\InvCraft\menu\CraftMenu;
use NgLamVN\InvCraft\menu\ViewRecipe;
use NgLamVN\InvCraft\Recipe;
use pocketmine\player\Player;
use pocketmine\Server;

class PlayerUI{
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
					$this->viewRecipe($player);
					break;
			}
		});

		$form->setTitle(FILang::translate($player, TranslationFactory::invc_ui_title_player()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_6x6recipe()));
		$form->addButton(FILang::translate($player, TranslationFactory::invc_ui_3x3recipe()));
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
