<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class DailyRewardCommand extends BaseCommand{

	protected function prepare() : void{
		$this->setPermission("dailyreward.command");
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		if ($sender instanceof Player){
			new ClaimMenu($sender);
		}
	}
}