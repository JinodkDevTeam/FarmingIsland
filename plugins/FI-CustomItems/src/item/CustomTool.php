<?php
declare(strict_types=1);

namespace CustomItems\item;

use pocketmine\event\block\BlockBreakEvent;

class CustomTool extends CustomItem{

	public function onDestroyBlock(BlockBreakEvent $event) : void{ }
}