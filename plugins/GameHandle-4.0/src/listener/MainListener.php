<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\listener;

use Exception;
use FILang\FILang;
use FILang\FILang as Lang;
use FILang\TranslationFactory as TF;
use FishingModule\event\EntityFishEvent;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\Core;
use NgLamVN\GameHandle\fishing\FishingManager;
use NgLamVN\GameHandle\GameMenu\Menu;
use onebone\economyapi\EconomyAPI;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\player\Player;
use pocketmine\Server;

class MainListener implements Listener{
	public Core $plugin;
	public Menu $menu;
	public FishingManager $fish;

	public function __construct(Core $plugin){
		$this->plugin = $plugin;
		$this->menu = new Menu();
		$this->fish = new FishingManager();
	}

	/**
	 * @param PlayerJoinEvent $event
	 *
	 * @priority HIGHEST
	 * @throws Exception
	 */
	public function onJoin(PlayerJoinEvent $event) : void{
		$player = $event->getPlayer();
		if($this->getCore()->getIslandWorldName() == null){
			return;
		}
		if($player->getWorld()->getDisplayName() !== $this->getCore()->getIslandWorldName()){
			Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), "mw tp " . $this->getCore()->getIslandWorldName() . " " . $player->getName());
		}
		$this->menu->registerMenuItem($player);
		$this->menu->sendUpdatesForm($player);
		$homes = MyPlot::getInstance()->getPlotsOfPlayer($player->getName(), $this->getCore()->getIslandWorldName());
		if(!empty($homes)){
			Server::getInstance()->dispatchCommand($player, "is home");
		}else{
			Server::getInstance()->dispatchCommand($player, "is auto");
			Server::getInstance()->dispatchCommand($player, "is claim");
			$player->sendMessage(Lang::translate($player, TF::gh_startgame()));
		}
		$this->getCore()->getPlayerStatManager()->registerPlayerStat($player);
	}

	public function getCore() : Core{
		return $this->plugin;
	}

	/**
	 * @param PlayerRespawnEvent $event
	 *
	 * @priority HIGHEST
	 */
	public function onRespawn(PlayerRespawnEvent $event) : void{
		$player = $event->getPlayer();
		if($this->getCore()->getIslandWorldName() == null){
			return;
		}
		if(!isset(MyPlot::getInstance()->getPlotsOfPlayer($player->getName(), $this->getCore()->getIslandWorldName())[0])){
			return;
		}
		$plot = MyPlot::getInstance()->getPlotsOfPlayer($player->getName(), $this->getCore()->getIslandWorldName())[0];

		$plotLevel = MyPlot::getInstance()->getLevelSettings($plot->levelName);
		$pos = MyPlot::getInstance()->getPlotPosition($plot);
		$pos->x += floor($plotLevel->plotSize / 2) + 0.5;
		$pos->y += 1;
		$pos->z -= -90.5;

		$event->setRespawnPosition($pos);
	}

	/**
	 * @param PlayerInteractEvent $event
	 *
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 */
	public function onInteract(PlayerInteractEvent $event) : void{
		$this->menu->onTap($event);
	}

	/**
	 * @param PlayerItemUseEvent $event
	 *
	 * @priority MONITOR
	 * @handleCancelled FALSE
	 */
	public function onUse(PlayerItemUseEvent $event) : void{
		$this->menu->onTap($event);
	}

	/**
	 * @param EntityFishEvent $event
	 *
	 * @priority LOWEST
	 * @handleCancelled FALSE
	 */
	public function onFish(EntityFishEvent $event) : void{
		$this->fish->onFish($event);
	}

	/**
	 * @param PlayerDropItemEvent $event
	 *
	 * @priority NORMAL
	 * @handleCancelled FALSE
	 */
	public function onItemDrop(PlayerDropItemEvent $event) : void{
		$this->menu->onDrop($event);
	}

	public function onTrans(InventoryTransactionEvent $event) : void{
		$this->menu->onTrans($event);
	}

	public function onUseCommand(PlayerCommandPreprocessEvent $event) : void{
		$player = $event->getPlayer();
		$msg = $event->getMessage();
		if($msg[0] == "/"){
			$this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] use " . $msg);

			if($player->hasPermission("gh.notp.bypass")) return;
			$args = explode(" ", $event->getMessage());
			if(!($args[0] == "/tp")) return;
			if(isset($args[3])) return;
			if(!isset($args[1])) return;
			$target = $this->getCore()->getServer()->getPlayerByPrefix($args[1]);
			if($target == null) return;
			if($this->getCore()->getPlayerStatManager()->getPlayerStat($target)->isNoTP()){
				$player->sendMessage(FILang::translate($player, TF::gh_notp()));
				$this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] Command Cancelled due to NoTP");
				$event->cancel();
			}
			if(!isset($args[2])) return;
			$target = $this->getCore()->getServer()->getPlayerByPrefix($args[2]);
			if($target == null) return;
			if($this->getCore()->getPlayerStatManager()->getPlayerStat($target)->isNoTP()){
				$player->sendMessage(FILang::translate($player, TF::gh_notp()));
				$this->getCore()->getServer()->getLogger()->info("[CMD][" . $player->getName() . "] Command Cancelled due to NoTP");
				$event->cancel();
			}
		}
	}

	public function onChangeLevel(EntityTeleportEvent $event) : void{
		$entity = $event->getEntity();
		if($entity instanceof Player){
			if($event->getFrom()->getWorld()->getDisplayName() !== $event->getTo()->getWorld()->getDisplayName()){
				$this->getCore()->afktime[$entity->getName()] = 0;
			}
		}
	}

	public function onQuit(PlayerQuitEvent $event) : void{
		$player = $event->getPlayer();
		$this->getCore()->afktime[$player->getName()] = 0;
		$this->getCore()->getPlayerStatManager()->removePlayerStat($player);
	}

	/**
	 * @param PlayerChatEvent $event
	 *
	 * @priority LOWEST
	 * @ignoreCancelled TRUE
	 */
	public function onChat(PlayerChatEvent $event) : void{
		$player = $event->getPlayer();
		if($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isMuted()){
			$event->cancel();
		}
	}

	/**
	 * @param SignChangeEvent $event
	 *
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
	 *
	 * @priority LOWEST
	 * @ignoreCancelled TRUE
	 */
	public function onMove(PlayerMoveEvent $event) : void{
		$player = $event->getPlayer();
		if($this->getCore()->getPlayerStatManager()->getPlayerStat($player)->isFreeze()){
			$event->cancel();
		}
	}

	/**
	 * @param PlayerDeathEvent $event
	 *
	 * @priority LOWEST
	 */
	public function onDeath(PlayerDeathEvent $event) : void{
		$event->setKeepInventory(true);
		$lost = round(EconomyAPI::getInstance()->myMoney($event->getPlayer()), 2, PHP_ROUND_HALF_DOWN);
		EconomyAPI::getInstance()->reduceMoney($event->getPlayer(), $lost);
		$event->getPlayer()->sendMessage(Lang::translate($event->getPlayer(), TF::gh_died((string)$lost)));
	}
}