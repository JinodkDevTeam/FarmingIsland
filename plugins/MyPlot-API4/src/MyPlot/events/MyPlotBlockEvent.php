<?php
declare(strict_types=1);

namespace MyPlot\events;

use MyPlot\Plot;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Event;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\player\Player;

class MyPlotBlockEvent extends MyPlotPlotEvent implements Cancellable{
	use CancellableTrait;

	/** @var Block $block */
	private Block $block;
	/** @var BlockBreakEvent|BlockPlaceEvent|PlayerInteractEvent|SignChangeEvent $event */
	private BlockBreakEvent|PlayerInteractEvent|SignChangeEvent|BlockPlaceEvent $event;
	/** @var Player $player */
	private Player $player;

	/**
	 * MyPlotBlockEvent constructor.
	 *
	 * @param Plot                                                                $plot
	 * @param Block                                                               $block
	 * @param Player                                                              $player
	 * @param BlockBreakEvent|PlayerInteractEvent|SignChangeEvent|BlockPlaceEvent $event
	 */
	public function __construct(Plot $plot, Block $block, Player $player, BlockBreakEvent|PlayerInteractEvent|SignChangeEvent|BlockPlaceEvent $event){
		$this->block = $block;
		$this->player = $player;
		$this->event = $event;
		parent::__construct($plot);
	}

	public function getBlock() : Block{
		return $this->block;
	}

	/**
	 * @return Event
	 */
	public function getEvent() : Event{
		return $this->event;
	}

	public function getPlayer() : Player{
		return $this->player;
	}
}