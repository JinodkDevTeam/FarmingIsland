<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

abstract class BaseBreakTime{
	/** @var string $name */
	protected string $name;

	/**
	 * BaseBreakTime constructor.
	 *
	 * @param string $name
	 */
	public function __construct(string $name){
		$this->name = $name;
	}

	/**
	 * @param Block  $block
	 * @param Item   $itemuse
	 * @param Player $player
	 *
	 * @return int
	 */
	protected function getBreakTime(Block $block, Item $itemuse, Player $player) : int{
		return 0;
	}

	public function reCaculateBreakTime(Block $block, Item $itemuse, Player $player): int{
		return $this->getBreakTime($block, $itemuse, $player);
	}

	/**
	 * @return string
	 * Return name of Base break time config
	 */
	public function getName() : string{
		return $this->name;
	}

	/**
	 * @param Vector3 $pos
	 * @param Item    $item
	 * @param Player  $player
	 * @param bool    $createParticles
	 */
	public function onBreak(Vector3 $pos, Item $item, Player $player, bool $createParticles = true) : void{
		$player->getWorld()->useBreakOn($pos, $item, $player, $createParticles);
	}
}