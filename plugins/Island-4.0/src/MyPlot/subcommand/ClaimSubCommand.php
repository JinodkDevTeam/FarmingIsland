<?php
declare(strict_types=1);
namespace MyPlot\subcommand;

use CustomItems\item\CustomItemFactory;
use CustomItems\item\CustomItemIds;
use MyPlot\forms\MyPlotForm;
use MyPlot\forms\subforms\ClaimForm;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class ClaimSubCommand extends SubCommand
{
	public function canUse(CommandSender $sender) : bool {
		return ($sender instanceof Player) and $sender->hasPermission("myplot.command.claim");
	}

	/**
	 * @param Player $sender
	 * @param string[] $args
	 *
	 * @return bool
	 */
	public function execute(CommandSender $sender, array $args) : bool {
		$name = "";
		if(isset($args[0])) {
			$name = $args[0];
		}
		$plot = $this->plugin->getPlotByPosition($sender->getPosition());
		if($plot === null) {
			$sender->sendMessage(TextFormat::RED . $this->translateString("notinplot"));
			return true;
		}
		if($plot->owner != "") {
			if($plot->owner === $sender->getName()) {
				$sender->sendMessage(TextFormat::RED . $this->translateString("claim.yourplot"));
			}else{
				$sender->sendMessage(TextFormat::RED . $this->translateString("claim.alreadyclaimed", [$plot->owner]));
			}
			return true;
		}
		$maxPlots = $this->plugin->getMaxPlotsOfPlayer($sender);
		$plotsOfPlayer = 0;
		foreach($this->plugin->getPlotLevels() as $level => $settings) {
			$level = $this->plugin->getServer()->getWorldManager()->getWorldByName((string)$level);
			if($level !== null and $level->isLoaded()) {
				$plotsOfPlayer += count($this->plugin->getPlotsOfPlayer($sender->getName(), $level->getFolderName()));
			}
		}
		if($plotsOfPlayer >= $maxPlots) {
			$sender->sendMessage(TextFormat::RED . $this->translateString("claim.maxplots", [$maxPlots]));
			return true;
		}
		$economy = $this->plugin->getEconomyProvider();
		if($economy !== null and !$economy->reduceMoney($sender, $plot->price)) {
			$sender->sendMessage(TextFormat::RED . $this->translateString("claim.nomoney"));
			return true;
		}
		if($this->plugin->claimPlot($plot, $sender->getName(), $name)) {
			$inv = $sender->getInventory();
			$inv->addItem(VanillaItems::WHEAT_SEEDS()->setCount(10));
			$inv->addItem(VanillaItems::DIAMOND_HOE());
			$inv->addItem(ItemFactory::getInstance()->get(ItemIds::DIRT)->setCount(10));
			$inv->addItem(ItemFactory::getInstance()->get(ItemIds::SAPLING)->setCount(5));
			$inv->addItem(VanillaItems::BONE_MEAL()->setCount(20));
			$inv->addItem(CustomItemFactory::getInstance()->get(CustomItemIds::STARTER_ROD)->toItem());
			$sender->sendMessage($this->translateString("claim.success"));
		}else{
			$sender->sendMessage(TextFormat::RED . $this->translateString("error"));
		}
		return true;
	}

	public function getForm(?Player $player = null) : ?MyPlotForm {
		if($player !== null and ($plot = $this->plugin->getPlotByPosition($player->getPosition())) !== null)
			return new ClaimForm($player, $plot);
		return null;
	}
}