<?php
declare(strict_types=1);

namespace FILang;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Language;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class FILang extends PluginBase{

	public const SUPPORTED_LANGUAGES = [
		"eng"
	];
	/** @var Language[] */
	public static array $languages = [];

	protected function onLoad() : void{
		foreach(self::SUPPORTED_LANGUAGES as $lang){
			$this->saveResource("$lang.ini");
			self::$languages[$lang] = new Language($lang, $this->getDataFolder());
		}
	}

	public static function translate(ConsoleCommandSender|Player|string $lang, Translatable $translatable) : string{
		if ($lang instanceof Player) {
			$lang = self::getPlayerLanguage($lang);
		}
		if ($lang instanceof ConsoleCommandSender) {
			$lang = $lang->getLanguage()->getLang();
		}
		return self::$languages[$lang]->translate($translatable);
	}

	public static function getPlayerLanguage(Player $player) : string{
		//TODO: Changeable player language
		return "eng";
	}
}