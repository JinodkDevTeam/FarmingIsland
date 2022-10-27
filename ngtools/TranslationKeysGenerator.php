<?php
declare(strict_types=1);

const LANG_DIRECTORY = "plugins/FI-Lang/resources/eng.ini";

function getCurrentDir() : string{
	return __DIR__ . DIRECTORY_SEPARATOR;
}

function generate_translation_keys() : void{
	$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
	if(!$data){
		echo "Cannot open file " . LANG_DIRECTORY;
		return;
	}
	ob_start();
	$keys = array_keys($data);
	echo <<<'HEADER'
<?php
declare(strict_types=1);
	
namespace FILang;

final class TranslationKeys{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See ngtools\TranslationKeysGenerator.php
 	*/

HEADER;
	foreach($keys as $key){
		$string = str_replace(".", "_", $key);
		$string = strtoupper($string);
		echo "\tpublic const " . $string . " = \"" . $key . "\";" . PHP_EOL;
	}
	echo "}" . PHP_EOL;
	$contents = ob_get_clean();
	file_put_contents("plugins/FI-Lang/src/TranslationKeys.php", $contents);
	echo "Done generating TranslationFactory.\n";
}

function generate_translation_factory() : void{
	$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
	if(!$data){
		echo "Cannot open file " . LANG_DIRECTORY;
		return;
	}
	ob_start();
	$keys = array_keys($data);
	echo <<<'HEADER'
<?php
declare(strict_types=1);

namespace FILang;

use pocketmine\lang\Translatable;

class TranslationFactory{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See ngtools\TranslationKeysGenerator.php
 	*/
HEADER;

	foreach($keys as $key){
		$string = str_replace(".", "_", $key);
		$string = strtolower($string);

	}
}

generate_translation_keys();