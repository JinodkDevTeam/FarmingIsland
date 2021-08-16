<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle;

use FishingModule\event\PlayerFishEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChangeSkinEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use NgLamVN\GameHandle\GameMenu\Menu;
use MyPlot\MyPlot;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use Exception;

class EventListener implements Listener
{
    public Core $plugin;
    public Menu $menu;
    public FishingManager $fish;
    public SkillLevelHandle $slevel;

    public function __construct(Core $plugin)
    {
        $this->plugin = $plugin;
        $this->menu = new Menu();
        $this->fish = new FishingManager();
        $this->slevel = new SkillLevelHandle($plugin);
    }

    public function getCore(): Core
    {
        return $this->plugin;
    }

	/**
	 * @param PlayerJoinEvent $event
	 *
	 * @priority HIGHEST
	 * @throws Exception
	 */
    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        if ($player->getWorld()->getDisplayName() !== "island")
        {
            /*Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), "mw tp island ". $player->getName());*/
        }

        $this->menu->registerMenuItem($player);
        $this->menu->sendUpdatesForm($player);
        Server::getInstance()->dispatchCommand($player, "is home");

        $this->getCore()->skin[$player->getName()] = $player->getSkin();

        $this->getCore()->getPlayerStatManager()->registerPlayerStat($player);
    }
    public function onSkinChange (PlayerChangeSkinEvent $event)
    {
        $player = $event->getPlayer();
        $newSkin = $event->getNewSkin();

        $this->getCore()->skin[$player->getName()] = $newSkin;
    }

    /**
     * @param PlayerRespawnEvent $event
     * @priority HIGHEST
     */
    public function onRespawn (PlayerRespawnEvent $event)
    {
        $player = $event->getPlayer();
        if (!isset(MyPlot::getInstance()->getPlotsOfPlayer($player->getName(), "island")[0]))
		{
			return;
		}
        $plot = MyPlot::getInstance()->getPlotsOfPlayer($player->getName(), "island")[0];

        $plotLevel = MyPlot::getInstance()->getLevelSettings($plot->levelName);
        $pos = MyPlot::getInstance()->getPlotPosition($plot);
        $pos->x += floor($plotLevel->plotSize / 2) + 0.5;
        $pos->y += 1;
        $pos->z -= -90.5;

        $event->setRespawnPosition($pos);
    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $this->menu->onTap($event);
    }

    public function onFish(PlayerFishEvent $event)
    {
        $this->fish->onFish($event);
    }

	/**
	 * @param PlayerDropItemEvent $event
	 * @priority NORMAL
	 * @handleCancelled FALSE
	 */
	public function onItemDrop (PlayerDropItemEvent $event)
    {
        $this->menu->onDrop($event);
    }

    public function onTrans (InventoryTransactionEvent $event)
    {
        $this->menu->onTrans($event);
    }

    public function onUseCommand (PlayerCommandPreprocessEvent $event): void
    {
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        if ($msg[0] == "/") {
            $this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] use " . $msg);

            if ($player->hasPermission("gh.notp.bypass")) return;
            $args = explode(" ", $event->getMessage());
            if (!($args[0] == "/tp")) return;
            if (isset($args[3])) return;
            if (!isset($args[1])) return;
            $target = $this->getCore()->getServer()->getPlayerByPrefix($args[1]);
            if ($target == null) return;
            if ($this->getCore()->getPlayerStatManager()->getPlayerStat($target)->isNoTP())
            {
                $player->sendMessage("§cThis Player Is Not Accepting TP");
                $this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] Command Cancelled due to NoTP");
                $event->cancel();
            }
            if (!isset($args[2])) return;
            $target = $this->getCore()->getServer()->getPlayerByPrefix($args[2]);
            if ($target == null) return;
            if ($this->getCore()->getPlayerStatManager()->getPlayerStat($target)->isNoTP())
            {
                $player->sendMessage("§cThis Player Is Not Accepting TP");
                $this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] Command Cancelled due to NoTP");
                $event->cancel();
            }
        }
    }

    public function onChangeLevel (EntityTeleportEvent $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player)
        {
        	if ($event->getFrom()->getWorld()->getDisplayName() !== $event->getTo()->getWorld()->getDisplayName())
			{
				$this->getCore()->afktime[$entity->getName()] = 0;
			}
        }
    }

    public function onQuit (PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $this->getCore()->afktime[$player->getName()] = 0;
        $this->getCore()->getPlayerStatManager()->removePlayerStat($player);
    }

    /**
     * @param PlayerChatEvent $event
     * @priority LOWEST
     * @ignoreCancelled TRUE
     */
    public function onChat (PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        if ($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isMuted())
        {
            $event->cancel();
        }
    }

    /**
     * @param SignChangeEvent $event
     * @priority HIGHEST
     * @ignoreCancelled TRUE
     */
    /*public function onEditSign (SignChangeEvent $event)
    {
        $player = $event->getPlayer();
        $lines = $event->getLines();
        $pos = $event->getBlock()->asPosition();

        $this->getCore()->getLogger()->info("[SignAdd][".$player->getName()."] edit sign on pos (".$pos->getX()."-".$pos->getY()."-".$pos->getZ().") world:". $pos->getLevel()->getName());
        foreach ($lines as $line)
        {
            $this->getCore()->getLogger()->info("[SignInfo] " . $line);
        }
    }*/

    /**
     * @param PlayerMoveEvent $event
     * @priority LOWEST
     * @ignoreCancelled TRUE
     */
    public function onMove (PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        if ($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isFreeze())
        {
            $event->cancel();
        }
    }

	/**
	 * @param BlockBreakEvent $event
	 * @priority HIGHEST
	 * @handleCancelled FALSE
	 */
	public function onBlockBreak(BlockBreakEvent $event)
	{
		$this->slevel->onBreak($event);
	}
}