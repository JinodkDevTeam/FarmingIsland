<?php
declare(strict_types=1);

namespace NgLamVN\InvCraft\ui;

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

		$form->setTitle($this->getLoader()->getProvider()->getMessage("ui.title.player"));
		$form->addButton($this->getLoader()->getProvider()->getMessage("ui.6x6recipe"));
		$form->addButton($this->getLoader()->getProvider()->getMessage("ui.3x3recipe"));
		$form->addButton($this->getLoader()->getProvider()->getMessage("ui.list"));

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
			$player->sendMessage($this->getLoader()->getProvider()->getMessage("msg.norecipe"));
			return;
		}

		$form = new SimpleForm(function(Player $player, $data) use ($recipes){
			if(!isset($data)){
				return;
			}
			new ViewRecipe($player, $this->getLoader(), $recipes[$data]);
		});

		$form->setTitle($this->getLoader()->getProvider()->getMessage("ui.list"));
		foreach($this->getLoader()->getRecipes() as $recipe){
			$form->addButton($recipe->getRecipeName());
		}

		$player->sendForm($form);
	}
}
