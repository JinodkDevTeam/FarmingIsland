<?php
declare(strict_types=1);

namespace FILang;

use FILang\sessions\SessionManager;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class FILangCommand extends Command implements PluginOwned{
	use PluginOwnedTrait;

	public function __construct(Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = []){
		$this->setDescription("Change your language");
		$this->setAliases(["lang"]);
		$this->setPermission("filang.command");
		parent::__construct("filang", $description, $usageMessage, $aliases);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : void{
		if ($sender instanceof Player){
			$this->form($sender);
		} else {
			$sender->sendMessage(FILang::translate($sender, TranslationFactory::command_ingame()));
		}
	}

	public function form(Player $player) : void{
		$form = new SimpleForm(function(Player $player, ?int $data){
			if ($data === null) return;
			$session = SessionManager::getSession($player);
			if ($session === null) return;
			$session->setLang(FILang::SUPPORTED_LANGUAGES[$data]);
			$player->sendMessage(FILang::translate($player, TranslationFactory::filang_languagechange()));
		});
		$form->setTitle(FILang::translate($player, TranslationFactory::filang_ui_title()));
		$form->setContent(FILang::translate($player, TranslationFactory::filang_ui_content()));
		foreach(FILang::SUPPORTED_LANGUAGES as $lang){
			$form->addButton(FILang::translate($lang, TranslationFactory::language_name()));
		}
		$player->sendForm($form);
	}
}