<?php
declare(strict_types=1);

function getCurrentDir(): string{
	return __DIR__ . DIRECTORY_SEPARATOR;
}

function makeJson() : void{
	$list_files = scandir("D:/MinecraftTool/Texture/FI-Fish/textures/items");
	if(!file_exists(getCurrentDir() . "output/")){
		mkdir(getCurrentDir() . "output");
	}
	$name_file = fopen(getCurrentDir() . "output/name.lang", "w");
	$register_file = fopen(getCurrentDir() . "output/register.php", "w");
	if(!$name_file){
		echo "Cannot open file name.lang";
		return;
	}
	if(!$register_file){
		echo "Cannot open file register.php";
		return;
	}
	fwrite($register_file, "<?php" . PHP_EOL . PHP_EOL);
	foreach($list_files as $full_file_name){
		if(str_contains($full_file_name, ".png")){
			$file_name = str_replace(".png", "", $full_file_name);
			$file_name_explode = explode("_", $file_name);
			foreach($file_name_explode as $i => $letter){
				$file_name_explode[$i] = ucfirst($letter);
			}
			$fish_name = implode(" ", $file_name_explode);
			$fish_class_name = implode("", $file_name_explode);
			fwrite($name_file, "item.fi-fish:" . $file_name . "=" . $fish_name . PHP_EOL);
			$class_file = fopen(getCurrentDir() . "output/" . $fish_class_name . ".php", "w");
			if(!$class_file){
				echo "Cannot open file " . $fish_class_name . ".php";
				return;
			}
			$properties = [
				"<?php",
				"declare(strict_types=1);",
				"",
				"namespace CustomItems\customies;",
				"",
				"class " . $fish_class_name . " extends CustomFish{",
				"	public function getTexture() : string{",
				'		return "' . $file_name . '";',
				"	}",
				"}"
			];
			fwrite($class_file, implode(PHP_EOL, $properties));
			fclose($class_file);

			fwrite($register_file, 'CustomiesItemFactory::getInstance()->registerItem(' . $fish_class_name . '::class, "fi-fish:' . $file_name . '", "' . $fish_name . '");' . PHP_EOL);
		}
	}
	fclose($name_file);
	fclose($register_file);
}

function makeJson2() : void{
	echo "Making config...";
	$list_files = scandir("D:/MinecraftTool/Texture/FI-Fish/textures/items");
	if(!file_exists(getCurrentDir() . "output/")){
		mkdir(getCurrentDir() . "output");
	}
	$method_file = fopen(getCurrentDir() . "output/method.php", "w");
	$register_file = fopen(getCurrentDir() . "output/register.php", "w");
	if(!$method_file){
		echo "Cannot open file method.php";
		return;
	}
	if(!$register_file){
		echo "Cannot open file register.php";
		return;
	}
	fwrite($register_file, "<?php" . PHP_EOL . PHP_EOL);
	foreach($list_files as $full_file_name){
		if(str_contains($full_file_name, ".png")){
			$file_name = str_replace(".png", "", $full_file_name);
			fwrite($method_file, '* @method static CustomFish ' . strtoupper($file_name) . '()' . PHP_EOL);
			fwrite($register_file, 'self::register("' . $file_name . '", $factory->get("fi-fish:' . $file_name . '"));' . PHP_EOL);
		}
	}
	fclose($method_file);
	fclose($register_file);
}

function makeJson3() : void{
	echo "Making config...";
	$list_files = scandir("D:/MinecraftTool/Texture/FI-Fish/textures/items");
	if(!file_exists(getCurrentDir() . "output/")){
		mkdir(getCurrentDir() . "output");
	}
	$data_file = fopen(getCurrentDir() . "output/data.php", "w");
	if(!$data_file){
		echo "Cannot open file data.php";
		return;
	}
	fwrite($data_file, "<?php" . PHP_EOL . PHP_EOL);
	foreach($list_files as $full_file_name){
		if(str_contains($full_file_name, ".png")){
			$file_name = str_replace(".png", "", $full_file_name);
			fwrite($data_file, 'CustomiesItems::' . strtoupper($file_name) .'(),' . PHP_EOL);
		}
	}
}

makeJson3();