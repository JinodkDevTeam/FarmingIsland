<?php

namespace NgLamVN\RankColor;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use _64FF00\PurePerms\event\PPGroupChangedEvent;
use pocketmine\player\Player;

class EventListener implements Listener
{
    private RankColor $plugin;

    public function __construct(RankColor $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getPlugin(): ?RankColor
    {
        return $this->plugin;
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        if ($this->plugin->getColor($player) !== null)
        {
            return;
        }
        $this->plugin->setDefaultColor($player);
    }

    /**
	 * @param PPGroupChangedEvent $event
     * @priority HIGHEST
     * @ignoreCancelled true
     */
    public function onGroupChange (PPGroupChangedEvent $event)
    {
        $player = $event->getPlayer();
        if ($player instanceof Player)
        {
            $this->plugin->setDefaultColor($player);
        }
    }
}