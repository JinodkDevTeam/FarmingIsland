<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator\generator\object\tree;

use pocketmine\world\BlockTransaction;
use Random;

class TallBirchTree extends BirchTree{

	public function __construct(Random $random, BlockTransaction $transaction){
		parent::__construct($random, $transaction);
		$this->setHeight($this->height + $random->nextBoundedInt(7));
	}
}