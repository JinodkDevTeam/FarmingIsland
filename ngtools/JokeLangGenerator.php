<?php
declare(strict_types=1);

/**
 * This feature use for generating some really fun language like Router...
 */

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

function generateLang(Closure $formatCallback, string $target) : void{
	$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
	if(!$data){
		echo "Cannot open file " . LANG_DIRECTORY;
		return;
	}
	ob_start();
	echo "; This file is generated automatically, do NOT modify it by hand.\n";
	echo "; See ngtools\JokeLangGenerator.php\n";
	echo PHP_EOL;
	foreach(stringifyKeys($data) as $key => $value){
		$format = $formatCallback($value);
		echo $key . "=" . $format . PHP_EOL;
	}
	$contents = ob_get_clean();
	file_put_contents($target, $contents);
}

function RandomCapsProtectParams(string $value) : string{
	$parameterRegex = '/{%(.+?)}/';
	$match = preg_match_all($parameterRegex, $value, $matches);
	if($match > 0){
		$str = implode("", array_map(fn($char) => (rand(0, 1) === 1) ? strtoupper($char) : $char, str_split(strtolower(str_replace($matches[0], "_", $value, $count)))));
		for($i = 0; $i < $count; $i++){
			$str = substr_replace($str, $matches[0][$i], strpos($str, "_"), 1);
		}
		return $str;
	}
	return implode("", array_map(fn($char) => (rand(0, 1) === 1) ? strtoupper($char) : $char, str_split(strtolower($value))));
}

function RemoveProtectParams(string $value, array &$matches, int &$count, string $replace_value = "_") : string{
	$parameterRegex = '/{%(.+?)}/';
	$match = preg_match_all($parameterRegex, $value, $matches);
	if ($match > 0) {
		return str_replace($matches[0], $replace_value, $value, $count);
	}
	return $value;
}

function RemoveProtectColorFormat(string $value, &$matches, &$count, string $replace_value = "^") : string{
	$parameterRegex = '/§([0-9a-f])/';
	$match = preg_match_all($parameterRegex, $value, $matches);
	if ($match > 0) {
		return str_replace($matches[0], $replace_value, $value, $count);
	}
	return $value;
}

generateLang(fn($value) => "Router", "plugins/FI-Lang/resources/lang/router.ini");
generateLang(fn($value) => RandomCapsProtectParams($value), "plugins/FI-Lang/resources/lang/randomCaps.ini");