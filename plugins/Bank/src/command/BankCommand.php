<?php
declare(strict_types=1);

namespace Bank\command;

use Bank\Bank;
use Bank\ui\BankUI;
use FILang\FILang;
use FILang\TranslationFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

class BankCommand extends Command implements PluginOwned{
	use PluginOwnedTrait;

	private Bank $bank;

	public function __construct(Bank $bank, string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = []){
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->bank = $bank;
		$this->setDescription("Bank manager");
		$this->setPermission("bank.command");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage(FILang::translate($sender, TranslationFactory::command_ingame()));
			return;
		}
		new BankUI($sender, $this->getBank());
	}

	private function getBank() : Bank{
		return $this->bank;
	}
}