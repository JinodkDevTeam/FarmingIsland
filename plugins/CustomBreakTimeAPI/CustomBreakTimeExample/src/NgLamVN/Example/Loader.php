<?php
declare(strict_types=1);

namespace NgLamVN\Example;

use NgLamVN\CustomBreakTimeAPI\CustomBreakTimeAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
	public function onEnable() : void{
		CustomBreakTimeAPI::register(new CustomShears("CustomShears"));
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		$cmd = strtolower($command->getName());
		if($cmd == "givetestitem"){
			$item = Item::get(Item::BLAZE_ROD);
			$nbt = $item->getNamedTag();
			$nbt->setString("basebreaktime", "CustomShears");
			$item->setNamedTag($nbt);
			$item->setCustomName("Test Shears");
			$sender->getInventory()->addItem($item);
		}
		return true;
	}
}
