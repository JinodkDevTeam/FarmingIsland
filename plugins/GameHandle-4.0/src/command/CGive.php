<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use CustomItems\item\CustomItemFactory;
use CustomItems\item\utils\StringToCustomItemParser;
use Exception;
use NgLamVN\GameHandle\command\args\CustomItemIDArgs;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CGive extends BaseCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	public function prepare() : void{
		$this->setDescription("Give a item from Custom Item Code");
		$this->setPermission("gh.cgive");

		$this->registerArgument(0, new CustomItemIDArgs());
		$this->registerArgument(1, new IntegerArgument("Amount", true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if(!$sender instanceof Player){
			$sender->sendMessage("Use in-game only");
			return;
		}
		if(isset($args["ItemID"])){
			try{
				if(is_numeric($args["ItemID"])){
					$item = CustomItemFactory::getInstance()->get((int) $args["ItemID"]);
				}else{
					$item = StringToCustomItemParser::getInstance()->parse($args["ItemID"]);
				}
				if($item == null){
					$sender->sendMessage("Unknow item ID");
					return;
				}
				$amount = $args["Amount"] ?? 1;
				$item = $item->toItem();
				$item->setCount($amount);
				if(!$sender->getInventory()->canAddItem($item)){
					$sender->sendMessage("Failed to add item to your inventory, make sure you have enough space !");
					return;
				}
				$sender->getInventory()->addItem($item);
				$sender->sendMessage("Item Added !");
			}catch(Exception $exception){
				$sender->sendMessage($exception->getMessage());
				$sender->sendMessage("Line: " . $exception->getLine());
				$sender->sendMessage("Error while decode give items");
			}
		}else{
			$sender->sendMessage("/cgive <item_code>");
		}
	}
}
