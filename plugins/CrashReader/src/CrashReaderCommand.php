<?php
declare(strict_types=1);

namespace CrashReader;

use CortexPE\Commando\BaseCommand;
use Exception;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CrashReaderCommand extends BaseCommand{

	protected function prepare() : void{
		$this->setPermission("crashreader.cmd");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if ($sender instanceof Player){
			$this->listForm($sender);
		} else {
			$sender->sendMessage("Please use this feature in-game !");
		}
	}

	public function listForm(Player $player){
		try{
			$list = scandir("crashdumps");
		}catch(Exception){
			$list = [];
		}
		$form = new SimpleForm(function(Player $player, ?int $data) use ($list){
			if(is_null($data)){
				return;
			}
			$this->viewForm($player, $list[$data]);
		});
		$form->setTitle("Crashdumps");
		foreach($list as $file){
			$form->addButton($file);
		}
		$player->sendForm($form);
	}

	public function viewForm(Player $player, string $file_name){
		$form = new CustomForm(function(Player $player, ?array $data){
			//NOOP
		});
		$form->setTitle($file_name);
		$file_dir = "crashdumps/" . $file_name;
		try{
			$file = fopen($file_dir, "r");
			$file_size = filesize($file_dir);
			if ($file_size > 0){
				$text = fread($file, $file_size);
			} else {
				$text = "";
			}
		}catch(Exception){
			$text = "";
		}
		$text_list = explode(PHP_EOL, (string)$text); //FIX WEIRD CHARACTER
		var_dump($text_list);
		foreach($text_list as $stream){
			$form->addLabel($stream);
		}
		$player->sendForm($form);
	}
}