<?php
declare(strict_types=1);

function getCurrentDir(): string{
	return __DIR__ . DIRECTORY_SEPARATOR;
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