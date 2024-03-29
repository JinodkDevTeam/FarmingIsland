<?php
declare(strict_types = 1);

namespace BlockHorizons\BlockPets\commands;

use BlockHorizons\BlockPets\Loader;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class ChangePetNameCommand extends BaseCommand {

	public function __construct(Loader $loader) {
		parent::__construct($loader, "changepetname", "Changes the name of a pet", "/changepetname <pet name> <new name> [player]", ["cpn, chpn"]);
		$this->setPermission("blockpets.command.changepetname.use");
	}

	public function onCommand(CommandSender $sender, string $commandLabel, array $args): bool {
		if(!($sender instanceof Player) && count($args) !== 3) {
			$this->sendConsoleError($sender);
			return false;
		}

		if(!isset($args[1]) || empty(trim($args[1]))) {
			$this->sendWarning($sender, "The name you entered is invalid.");
			return true;
		}

		$newName = $args[1];

		if(isset($args[2])) {
			if($sender instanceof Player && $sender->hasPermission("blockpets.command.changepetname.others")) {
				$this->sendPermissionMessage($sender);
				return true;
			}
			if(($player = $this->getLoader()->getServer()->getPlayerByPrefix($args[2])) === null) {
				$this->sendWarning($sender, $this->getLoader()->translate("commands.errors.player.not-found"));
				return true;
			}
			if(($pet = $this->getLoader()->getPetByName($args[0], $player->getName())) === null) {
				$this->sendWarning($sender, $this->getLoader()->translate("commands.errors.player.no-pet-other"));
				return true;
			}
			$oldName = $pet->getPetName();
			$pet->changeName($newName);
			$sender->sendMessage(TF::GREEN . $this->getLoader()->translate("commands.changepetname.success", [
					$oldName,
					$newName
				]));
			return true;
		}

		if(($pet = $this->getLoader()->getPetByName($args[0], $sender->getName())) === null) {
			$this->sendWarning($sender, $this->getLoader()->translate("commands.errors.player.no-pet"));
			return true;
		}

		$oldName = $pet->getPetName();
		$pet->changeName($newName);
		$sender->sendMessage(TF::GREEN . $this->getLoader()->translate("commands.changepetname.success", [
			$oldName,
			$newName
		]));
		return true;
	}
}
