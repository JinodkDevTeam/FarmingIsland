<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use Exception;
use NgLamVN\GameHandle\Core;
use NgLamVN\GameHandle\utils\StringNBTParser;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;

class IcGive extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "icgive");
		$this->setDescription("Give a item from Item code (using InvCraft save format)");
		$this->setPermission("gh.icgive");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("Use in-game only");
			return;
		}
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.icgive")){
				$sender->sendMessage("You not have permission to use this command !");
				return;
			}
			try{
				$stream = new StringNBTParser();
				$code = hex2bin($args[0]);
				if($code == false){
					$sender->sendMessage("Failed to decode item code !");
					return;
				}
				$treeroot = $stream->readCompressed($code);
				$nbt = $treeroot->getTag();
				if(!$nbt instanceof CompoundTag){
					$sender->sendMessage("Failed to decode item code to item NBT !");
					return;
				}
				$item = Item::nbtDeserialize($nbt);
				if(!$sender->getInventory()->canAddItem($item)){
					$sender->sendMessage("Failed to add item to your inventory, make sure you have enough space !");
					return;
				}
				$sender->getInventory()->addItem($item);
				$sender->sendMessage("Item Added !");
			}catch(Exception){
				$sender->sendMessage("Error while decode give items");
			}
		}else{
			$sender->sendMessage("/icgive <item_code>");
		}
	}
}
