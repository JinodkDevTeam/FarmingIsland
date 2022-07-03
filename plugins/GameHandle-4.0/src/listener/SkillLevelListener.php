<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\listener;

use FishingModule\event\EntityFishEvent;
use NgLamVN\GameHandle\Core;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\SweetBerryBush;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Fertilizer;
use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\SkillLevel;

class SkillLevelListener implements Listener{
	private array $mining;
	private array $farming;
	private array $farming2;
	private array $farming3;
	private array $foraging;


	private Core $core;

	public function __construct(Core $core){
		$this->core = $core;

		$this->mining = [
			BlockLegacyIds::STONE => 1,
			BlockLegacyIds::COBBLESTONE => 1,
			BlockLegacyIds::COAL_ORE => 2,
			BlockLegacyIds::IRON_ORE => 3,
			BlockLegacyIds::GOLD_ORE => 4,
			BlockLegacyIds::LAPIS_ORE => 2,
			BlockLegacyIds::REDSTONE_ORE => 2,
			BlockLegacyIds::LIT_REDSTONE_ORE => 2,
			BlockLegacyIds::EMERALD_ORE => 5,
			BlockLegacyIds::DIAMOND_ORE => 6
		];
		// FOR BREAKABLE CROPS
		$this->farming = [
			BlockLegacyIds::WHEAT_BLOCK => 1,
			BlockLegacyIds::CARROT_BLOCK => 1,
			BlockLegacyIds::POTATO_BLOCK => 1,
			BlockLegacyIds::BEETROOT_BLOCK => 1,
			BlockLegacyIds::NETHER_WART_PLANT => 1,
		];
		//FOR INTERACT CROPS
		$this->farming2 = [
			BlockLegacyIds::SWEET_BERRY_BUSH => 2
		];
		//FOR SPECIAL BREAK CROPS
		$this->farming3 = [
			BlockLegacyIds::CACTUS => 1,
			BlockLegacyIds::SUGARCANE_BLOCK => 1,
			BlockLegacyIds::BAMBOO => 1,
			BlockLegacyIds::MELON_BLOCK => 2,
			BlockLegacyIds::PUMPKIN => 2
		];

		$this->foraging = [
			BlockLegacyIds::LOG => 1,
			BlockLegacyIds::LOG2 => 1
		];
	}

	public function getCore() : Core{
		return $this->core;
	}

	/**
	 * @param BlockBreakEvent $event
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 *
	 * @return void
	 */
	public function onBreak(BlockBreakEvent $event) : void{
		$player = $event->getPlayer();
		$block = $event->getBlock();

		//MINING
		if(in_array($block->getId(), array_keys($this->mining))){
			$amount = $this->mining[$block->getId()];
			$this->addXp($player, SkillLevel::MINING, $amount);
		}
		//FORAGING
		if(in_array($block->getId(), array_keys($this->foraging))){
			$amount = $this->foraging[$block->getId()];
			$this->addXp($player, SkillLevel::FORAGING, $amount);
		}
		//FARMING TYPE 1
		if(in_array($block->getId(), array_keys($this->farming))){
			if($block->getMeta() == 7) //FULL GROW
			{
				$amount = $this->farming[$block->getId()];
				$this->addXp($player, SkillLevel::FARMING, $amount);
			}
		}
		//FARMING TYPE 2
		if(in_array($block->getId(), array_keys($this->farming3))){
			$amount = $this->farming3[$block->getId()];
			$this->addXp($player, SkillLevel::FARMING, $amount);
		}
	}

	/**
	 * @param EntityFishEvent $event
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 *
	 * @return void
	 */
	public function onFish(EntityFishEvent $event) : void{
		$player = $event->getEntity();
		if($player instanceof Player){
			if($event->getState() == EntityFishEvent::STATE_CAUGHT_FISH){
				$this->addXp($player, SkillLevel::FISHING, mt_rand(10, 100));
			}
		}
	}

	/**
	 * @param PlayerInteractEvent $event
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 *
	 * @return void
	 */
	public function onInteract(PlayerInteractEvent $event) : void{
		$player = $event->getPlayer();
		$block = $event->getBlock();
		$action = $event->getAction();
		if($action == PlayerInteractEvent::LEFT_CLICK_BLOCK) return;
		//FARMING TYPE 2
		if($block instanceof SweetBerryBush){ //Handle SweetBerries
			switch($block->getMeta()){
				case 2:
					if(!$event->getItem() instanceof Fertilizer){ //BONEMEAT WILL GROW ITEM, NOT DROP THE RESULT
						$amount = $this->farming2[$block->getId()];
						$this->addXp($player, SkillLevel::FARMING, $amount);
					}
					break;
				case 3:
					$amount = $this->farming2[$block->getId()] * 2;
					$this->addXp($player, SkillLevel::FARMING, $amount);
			}
		}
	}

	public function addXp(Player $player, int $skill_code, int $amount) : void{
		$data = $this->getSkillLevel()->getPlayerSkillLevelManager()->getPlayerSkillLevel($player);
		$data->addSkillExp($skill_code, $amount);

		$level = $data->getSkillLevel($skill_code);
		$exp = $data->getSkillExp($skill_code);

		$player->sendPopup($this->IdToSkillName($skill_code) . " " . $level . ": " . $exp . "/" . $data->getMaxExp($level) . " (+" . $amount . ")");
	}

	public function getSkillLevel() : ?SkillLevel{
		$sl = Server::getInstance()->getPluginManager()->getPlugin("FI-SkillLevel");
		if($sl instanceof SkillLevel){
			return $sl;
		}
		return null;
	}

	//TODO: FishingXP

	public function IdToSkillName(int $id) : string{
		return match ($id) {
			SkillLevel::MINING => "Mining",
			SkillLevel::FARMING => "Farming",
			SkillLevel::FORAGING => "Foraging",
			SkillLevel::FISHING => "Fishing"
		};
	}
}