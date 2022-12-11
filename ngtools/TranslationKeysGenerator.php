<?php
declare(strict_types=1);

const LANG_DIRECTORY = "plugins/FI-Lang/resources/lang/eng.ini";

function getCurrentDir() : string{
	return __DIR__ . DIRECTORY_SEPARATOR;
}

/**
 * @param array $array
 *
 * @description Avoid PHP auto-convert array keys to int lead to some crashs
 *
 * @return Generator
 */
function stringifyKeys(array $array) : Generator{
	foreach($array as $k => $v){
		yield (string) $k => $v;
	}
}

function generate_translation_keys() : void{
	$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
	if(!$data){
		echo "Cannot open file " . LANG_DIRECTORY;
		return;
	}
	ob_start();
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
	foreach(stringifyKeys($data) as $key => $_){
		$string = str_replace(".", "_", $key);
		$string = strtoupper($string);
		echo "\tpublic const " . $string . " = \"" . $key . "\";" . PHP_EOL;
	}
	echo "}" . PHP_EOL;
	$contents = ob_get_clean();
	file_put_contents("plugins/FI-Lang/src/TranslationKeys.php", $contents);
	echo "Done generating TranslationKeys.\n";
}

function generate_translation_factory() : void{
	$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
	if(!$data){
		echo "Cannot open file " . LANG_DIRECTORY;
		return;
	}
	ob_start();
	echo <<<'HEADER'
<?php
declare(strict_types=1);

namespace FILang;

use pocketmine\lang\Translatable;

final class TranslationFactory{
	/**
	* This class is generated automatically, do NOT modify it by hand.
	* See ngtools\TranslationKeysGenerator.php
 	*/

HEADER;

	$parameterRegex = '/{%(.+?)}/';
	foreach(stringifyKeys($data) as $key => $value){
		$parameters = [];
		$allParametersPositional = true;
		if(preg_match_all($parameterRegex, $value, $matches) > 0){
			foreach($matches[1] as $parameterName){
				if(is_numeric($parameterName)){
					$parameters[$parameterName] = "param$parameterName";
				}else{
					$parameters[$parameterName] = $parameterName;
					$allParametersPositional = false;
				}
			}
		}

		if($allParametersPositional){
			ksort($parameters, SORT_NUMERIC);
		}
		$functionName = strtolower(str_replace(".", "_", $key));
		$constantName = strtoupper($functionName);

		echo "\tpublic static function " .
			$functionName .
			"(" . implode(", ", array_map(fn(string $paramName) => "Translatable|string \$$paramName", $parameters)) . ") : Translatable{\n";
		echo "\t\treturn new Translatable(TranslationKeys::" . $constantName . ", [";
		foreach($parameters as $parameterKey => $parameterName){
			echo "\n\t\t\t";
			if(!is_numeric($parameterKey)){
				echo "\"$parameterKey\"";
			}else{
				echo $parameterKey;
			}
			echo " => \$$parameterName,";
		}
		if(count($parameters) !== 0){
			echo "\n\t\t";
		}
		echo "]);\n\t}\n\n";
	}
	echo "}" . PHP_EOL;
	$contents = ob_get_clean();
	file_put_contents("plugins/FI-Lang/src/TranslationFactory.php", $contents);
	echo "Done generating TranslationFactory.\n";
}

generate_translation_keys();
generate_translation_factory();
