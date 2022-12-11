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
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

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
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_invalidlevel()));
			return;
		}
		$effect = new EffectInstance(VanillaEffects::HASTE(), 99999999, $level, true);
		if(isset($args["player"])){
			if(!$sender->hasPermission("gh.haste.other")){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_other_noperm()));
				return;
			}
			$player = Server::getInstance()->getPlayerByPrefix($args["player"]);
			if(is_null($player)){
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_playernotfound()));
				return;
			}
			if($player->getEffects()->has(VanillaEffects::HASTE())){
				$player->getEffects()->remove(VanillaEffects::HASTE());
				$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_other_disable($player->getName())));
				return;
			}
			$player->getEffects()->add($effect);
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_other_enable($player->getName(), $level)));
			return;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Lang::translate($sender, TF::command_ingame()));
			return;
		}
		if($sender->getEffects()->has(VanillaEffects::HASTE())){
			$sender->getEffects()->remove(VanillaEffects::HASTE());
			$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_disable()));
			return;
		}
		$sender->getEffects()->add($effect);
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_haste_enable($level)));
	}
}

