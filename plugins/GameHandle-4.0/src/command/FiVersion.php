<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\command;

use NgLamVN\GameHandle\Core;
use pocketmine\command\CommandSender;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;

class FiVersion extends BaseCommand{

	protected function prepare() : void{
		$this->setDescription("FarmingIsland Version");
		$this->setPermission("gh.fiver");
		$this->setAliases(["fiver", "fi-ver"]);
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fiver_server(Core::VERSION, Core::CODE_NAME)));
		$sender->sendMessage(Lang::translate($sender, TF::gh_cmd_fiver_base((string)Core::BASE_VERSION)));
	}
}