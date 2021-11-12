<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CustomItems\item\CustomItemFactory;
use CustomItems\item\utils\StringToCustomItemParser;
use Exception;
use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CGive extends BaseCommand{
	public function __construct(Core $core){
		parent::__construct($core, "cgive");
		$this->setDescription("Give a item from Custom Item Code");
		$this->setPermission("gh.cgive");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("Use in-game only");
			return;
		}
		if(isset($args[0])){
			if(!$sender->hasPermission("gh.cgive")){
				$sender->sendMessage("You not have permission to use this command !");
				return;
			}
			try{
				if (is_numeric($args[0])){
					$item = CustomItemFactory::getInstance()->get((int) $args[0]);
				} else {
					$item = StringToCustomItemParser::getInstance()->parse($args[0]);
				}
				if($item == null){
					$sender->sendMessage("Unknow item ID");
					return;
				}
				$item = $item->toItem();
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
			$sender->sendMessage("/cgive <item_code>");
		}
	}
}
