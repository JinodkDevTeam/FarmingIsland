<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\exception\ArgumentOrderException;
use NgLamVN\GameHandle\command\args\PlayerArgs;
use pocketmine\command\CommandSender;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\player\Player;
use pocketmine\Server;

class Haste extends BaseCommand{
	/**
	 * @throws ArgumentOrderException
	 */
	protected function prepare() : void{
		$this->setDescription("Haste Effect");
		$this->setPermission("gh.haste");

		$this->registerArgument(0, new IntegerArgument("level", true));
		$this->registerArgument(1, new PlayerArgs(true));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$level = $args["level"] ?? 1;
		if ($level <= 0){
			$sender->sendMessage("Level must higher than 0");
			return;
		}
		$effect = new EffectInstance(VanillaEffects::HASTE(), 99999999, $level, true);
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.haste.other")){
				$sender->sendMessage("You don't have permission to enable haste on other player");
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage("Player didn't exist !");
				return;
			}
			if($player->getEffects()->has(VanillaEffects::HASTE())){
				$player->getEffects()->remove(VanillaEffects::HASTE());
				$sender->sendMessage("Disabled haste on " . $player->getName());
				return;
			}
			$player->getEffects()->add($effect);
			$sender->sendMessage("Enabled haste on " . $player->getName());
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage("Please use this command in-game");
			return;
		}
		if($sender->getEffects()->has(VanillaEffects::HASTE())){
			$sender->getEffects()->remove(VanillaEffects::HASTE());
			$sender->sendMessage("Haste Disabled !");
			return;
		}
		$sender->getEffects()->add($effect);
		$sender->sendMessage("Haste Enabled !");
	}
}

