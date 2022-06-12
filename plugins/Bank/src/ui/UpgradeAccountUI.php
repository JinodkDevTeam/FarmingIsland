<?php
declare(strict_types=1);

namespace Bank\ui;

use jojoe77777\FormAPI\ModalForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class UpgradeAccountUI extends BankUI{

	public function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield $this->getBank()->getProvider()->get($player);
			if(empty($data)){
				$player->sendMessage("Error: Can't get data from database, please report this error to admin !");
				return;
			}
			$current_upgrade = (int) $data[0]["Upgrade"];
			$current_upgrade_name = $this->getBank()->getProvider()->getUpgradeName($current_upgrade);
			$next_upgrade_name = $this->getBank()->getProvider()->getUpgradeName($current_upgrade + 1);
			$next_upgrade_cost = $this->getBank()->getProvider()->getUpgradeCost($current_upgrade + 1);
			$max_upgrade = $this->getBank()->getProvider()->getMaxUpgrade();
			if($current_upgrade == $max_upgrade){
				$player->sendMessage("Your account is already the highest upgrade!");
				return;
			}
			$form = new ModalForm(function(Player $player, ?bool $value) use ($next_upgrade_cost, $current_upgrade){
				$purse = EconomyAPI::getInstance()->myMoney($player);
				if(is_null($value)) return;
				if (!$value){
					return;
				}
				if ($purse < $next_upgrade_cost) {
					$player->sendMessage("You don't have enough money to upgrade your account! Need " . $next_upgrade_cost . " but you only have " . $purse . " coins");
					return;
				}
				EconomyAPI::getInstance()->reduceMoney($player, $next_upgrade_cost);
				$this->getBank()->getProvider()->updateUpgrade($player, $current_upgrade + 1);
			});
			$form->setTitle("Confirm Upgrade");
			$content = [
				"Are you sure you want to upgrade your account?",
				"Current upgrade: " . $current_upgrade_name,
				"Next upgrade: " . $next_upgrade_name,
				"Cost: " . $next_upgrade_cost . " coins"
			];
			$form->setContent(implode("\n", $content));
			$form->setButton1("Yes");
			$form->setButton2("No");

			$player->sendForm($form);
		});
	}
}