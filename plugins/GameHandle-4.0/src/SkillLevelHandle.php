<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle;

use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use SkillLevel\SkillLevel;

class SkillLevelHandle
{
	private array $mining;
	private array $farming;
	private array $farming2;
	private array $foraging;


	private Core $core;

	public function __construct(Core $core)
	{
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
			BlockLegacyIds::CACTUS => 2,
		];
		//FOR INTERACT CROPS
		$this->farming2 = [
			BlockLegacyIds::SWEET_BERRY_BUSH => 1
		];

		$this->foraging = [
			BlockLegacyIds::LOG => 1,
			BlockLegacyIds::LOG2 => 1
		];
	}

	public function getCore(): Core
	{
		return $this->core;
	}

	public function getSkillLevel(): ?SkillLevel
	{
		$sl = Server::getInstance()->getPluginManager()->getPlugin("FI-SkillLevel");
		if ($sl instanceof SkillLevel)
		{
			return $sl;
		}
		return null;
	}

	public function onBreak(BlockBreakEvent $event)
	{
		$player = $event->getPlayer();
		$block = $event->getBlock();

		if (in_array($block->getId(), array_keys($this->mining)))
		{
			$amount = $this->mining[$block->getId()];
			$this->addXp($player, SkillLevel::MINING, $amount);
		}
		if (in_array($block->getId(), array_keys($this->foraging)))
		{
			$amount = $this->foraging[$block->getId()];
			$this->addXp($player, SkillLevel::FORAGING, $amount);
		}
	}
	//TODO: Farming
	//TODO: Fishing
	//TODO: Farming2

	public function addXp(Player $player, int $skill_code, int $amount)
	{
		$data = $this->getSkillLevel()->getPlayerSkillLevelManager()->getPlayerSkillLevel($player);
		$data->addSkillExp($skill_code, $amount);

		$level = $data->getSkillLevel($skill_code);
		$exp = $data->getSkillExp($skill_code);

		$player->sendPopup($this->IdToSkillName($skill_code) . " " . $level . ": " . $exp . "/" . $data->getMaxExp($level) . " (+" . $amount . ")");
	}

	public function IdToSkillName(int $id): string
	{
		return match ($id)
		{
			SkillLevel::MINING => "Mining",
			SkillLevel::FARMING => "Farming",
			SkillLevel::FORAGING => "Foraging",
			SkillLevel::FISHING => "Fishing"
		};
	}
}