<?php
declare(strict_types=1);

const LANG_DIRECTORY = "plugins/FI-Lang/resources/eng.ini";

function getCurrentDir() : string{
	return __DIR__ . DIRECTORY_SEPARATOR;
}

$data = parse_ini_file(LANG_DIRECTORY, false, INI_SCANNER_RAW);
if(!$data){
	echo "Cannot open file " . LANG_DIRECTORY;
	return;
}
$keys = array_keys($data);
foreach($keys as $key){
	$string = str_replace(".", "_", $key);
	$string = strtoupper($string);
	echo "public const " . $string . " = \"" . $key . "\";" . PHP_EOL;
}