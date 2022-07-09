<?php
declare(strict_types=1);

namespace NgLamVN\Example;

use NgLamVN\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
	public function onEnable() : void{
		CustomBreakTimeAPI::register(new CustomShears("CustomShears"));
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if (!$sender instanceof Player){
			return true;
		}
		$cmd = strtolower($command->getName());
		if($cmd == "givetestitem"){
			$item = VanillaItems::BLAZE_ROD();
			$nbt = $item->getNamedTag();
			$nbt->setString("basebreaktime", "CustomShears");
			$item->setNamedTag($nbt);
			$item->setCustomName("Test Shears");
			$sender->getInventory()->addItem($item);
		}
		return true;
	}
}
