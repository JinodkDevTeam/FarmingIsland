<?php
declare(strict_types=1);

const TEXTURE_DIRECTORY = "D:/MinecraftTool/Texture/FI-CustomAddons/textures/items/";
const TEXTURE_NAME = "fici";

function getCurrentDir() : string{
	return __DIR__ . DIRECTORY_SEPARATOR;
}

function createClass(string $file_name = "", string $property_name = "") : void{
	$class_file = fopen(getCurrentDir() . "output/" . $file_name . ".php", "w");
	if(!$class_file){
		echo "Cannot open file " . $file_name . ".php";
		return;
	}
	$properties = [
		"<?php",
		"declare(strict_types=1);",
		"",
		"namespace CustomAddons\customies\\fish;",
		"",
		"class " . $file_name . " extends CustomFish{",
		"	public function getTexture() : string{",
		'		return "' . TEXTURE_NAME . "_" . $property_name . '";',
		"	}",
		"}"
	];
	fwrite($class_file, implode(PHP_EOL, $properties));
	fclose($class_file);
}

function scan($dir = "") : void{
	$list_files = scandir($dir);
	foreach($list_files as $file){
		echo $file . PHP_EOL;
		if ($file === ".") continue;
		if ($file === "..") continue;
		if (is_dir($dir . $file)){
			scan($dir . $file . DIRECTORY_SEPARATOR);
		} else {
			check($file);
		}
	}
}

function check(string $full_file_name = "") : void{
	if(str_contains($full_file_name, ".png")){
		$file_name = str_replace(".png", "", $full_file_name);
		$file_name_explode = explode("_", $file_name);
		foreach($file_name_explode as $i => $letter){
			$file_name_explode[$i] = ucfirst($letter);
		}
		$fish_name = implode(" ", $file_name_explode);
		$fish_class_name = implode("", $file_name_explode);
		fwrite($GLOBALS["name_file"], "item." . TEXTURE_NAME . ":" . $file_name . "=" . $fish_name . PHP_EOL);
		fwrite($GLOBALS["registerFactory_file"], 'CustomiesItemFactory::getInstance()->registerItem(' . $fish_class_name . '::class, "' . TEXTURE_NAME . ':' . $file_name . '", "' . $fish_name . '");' . PHP_EOL);
		fwrite($GLOBALS["method_file"], '* @method static CustomFish ' . strtoupper($file_name) . '()' . PHP_EOL);
		fwrite($GLOBALS["register_file"], 'self::register("' . $file_name . '", $factory->get("' . TEXTURE_NAME . ':' . $file_name . '"));' . PHP_EOL);
		createClass($fish_class_name, $file_name);
	}
}

$list_files = scandir(TEXTURE_DIRECTORY);
if(!file_exists(getCurrentDir() . "output/")){
	mkdir(getCurrentDir() . "output");
}
$name_file = fopen(getCurrentDir() . "output/en-US.lang", "w");
$registerFactory_file = fopen(getCurrentDir() . "output/registerFactory.php", "w");
$method_file = fopen(getCurrentDir() . "output/method.php", "w");
$register_file = fopen(getCurrentDir() . "output/register.php", "w");
if(!$name_file){
	echo "Cannot open file en-US.lang";
	return;
}
if(!$registerFactory_file){
	echo "Cannot open file register.php";
	return;
}
if(!$method_file){
	echo "Cannot open file method.php";
	return;
}
if(!$register_file){
	echo "Cannot open file register.php";
	return;
}
fwrite($registerFactory_file, "<?php" . PHP_EOL . PHP_EOL);
fwrite($register_file, "<?php" . PHP_EOL . PHP_EOL);
scan(TEXTURE_DIRECTORY);
fclose($name_file);
fclose($registerFactory_file);
fclose($method_file);
fclose($register_file);