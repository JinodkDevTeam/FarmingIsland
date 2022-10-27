<?php
declare(strict_types=1);

namespace FILang;

use pocketmine\lang\Language;
use pocketmine\lang\Translatable;
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
			self::$languages[$lang] = new Language($lang, $this->getDataFolder() . "$lang.ini");
		}
	}

	public static function translate(string $lang, Translatable $translatable) : string{
		return self::$languages[$lang]->translate($translatable);
	}
}