<?php
declare(strict_types=1);
namespace MyPlot\events;

use MyPlot\Plot;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;

class MyPlotFillEvent extends MyPlotPlotEvent implements Cancellable {
	use CancellableTrait;

	/** @var int $maxBlocksPerTick */
	private $maxBlocksPerTick;

	/**
	 * MyPlotFillEvent constructor.
	 *
	 * @param Plot $plot
	 * @param int $maxBlocksPerTick
	 */
	public function __construct(Plot $plot, int $maxBlocksPerTick = 256) {
		$this->maxBlocksPerTick = $maxBlocksPerTick;
		parent::__construct($plot);
	}

	/**
	 * @return int
	 */
	public function getMaxBlocksPerTick() : int {
		return $this->maxBlocksPerTick;
	}

	/**
	 * @param int $maxBlocksPerTick
	 *
	 * @return self
	 */
	public function setMaxBlocksPerTick(int $maxBlocksPerTick) : self {
		$this->maxBlocksPerTick = $maxBlocksPerTick;
		return $this;
	}
}