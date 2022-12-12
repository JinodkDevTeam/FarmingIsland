<?php
declare(strict_types=1);

namespace FILang;

use FILang\sessions\SessionManager;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\lang\Language;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class FILang extends PluginBase{

	public const SUPPORTED_LANGUAGES = [
		"eng",
		"vie",
	];
	/** @var Language[] */
	public static array $languages = [];
	public Config $data; //TODO: Use Database instead

	protected function onLoad() : void{
		foreach(self::SUPPORTED_LANGUAGES as $lang){
			$this->saveResource("lang". DIRECTORY_SEPARATOR . "$lang.ini");
			self::$languages[$lang] = new Language($lang, $this->getDataFolder() . DIRECTORY_SEPARATOR . "lang");
		}
		$this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
		$this->getServer()->getCommandMap()->register("filang", new FILangCommand());
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
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
		return SessionManager::getSession($player)?->getLang() ?? "eng";
	}
}