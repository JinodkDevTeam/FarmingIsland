<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use CustomItems\item\CustomItems;
use Exception;
use FILang\FILang;
use FILang\TranslationFactory as TF;
use NgLamVN\GameHandle\command\args\CustomItemIDArgs;
use pocketmine\player\Player;

class CGive extends IngameCommand{

	/**
	 * @throws ArgumentOrderException
	 */
	public function prepare() : void{
		$this->setDescription("Give a item from Custom Item Code");
		$this->setPermission("gh.cgive");

		$this->registerArgument(0, new CustomItemIDArgs());
		$this->registerArgument(1, new IntegerArgument("Amount", true));
	}

	public function handle(Player $player, string $aliasUsed, array $args) : void{
		if(isset($args["ItemID"])){
			try{
				$item = CustomItems::get($args["ItemID"]);
				if($item == null){
					$player->sendMessage(FILang::translate($player, TF::gh_cmd_cgive_fail_unknowid()));
					return;
				}
				$amount = $args["Amount"] ?? 1;
				$item = $item->toItem();
				$item->setCount($amount);
				if(!$player->getInventory()->canAddItem($item)){
					$player->sendMessage(FILang::translate($player, TF::gh_cmd_cgive_fail_notenoughspace()));
					return;
				}
				$player->getInventory()->addItem($item);
				$player->sendMessage(FILang::translate($player, TF::gh_cmd_cgive_success()));
			}catch(Exception $exception){
				$player->sendMessage($exception->getMessage());
				$player->sendMessage("Line: " . $exception->getLine());
				$player->sendMessage(FILang::translate($player, TF::gh_cmd_cgive_fail_decode()));
			}
		}else{
			$player->sendMessage("/cgive <item_code>");
		}
	}
}
