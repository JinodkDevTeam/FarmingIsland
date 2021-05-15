<?php

declare(strict_types=1);

namespace NgLamVN\NgTest;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
	public function onEnable() : void
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 * @ignoreCancelled true
	 */
	public function onBreak(BlockBreakEvent $event)
	{
		$block = $event->getBlock();
		$player = $event->getPlayer();

		$this->BreakForm($player, $block);
	}

	public function BreakForm (Player $player, Block $block)
	{
		$form = new CustomForm(function(Player $player, array $data)
		{
		});

		$form->setTitle("Block Break Info");
		$form->addLabel("You have break block: " . $block->getName());

		$player->sendForm($form);
	}
}
