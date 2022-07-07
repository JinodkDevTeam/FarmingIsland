<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use CortexPE\Hierarchy\Hierarchy;
use Exception;
use muqsit\invmenu\InvMenuHandler;
use MyPlot\MyPlot;
use NgLamVN\GameHandle\command\InitCommand;
use NgLamVN\GameHandle\listener\ListenerManager;
use NgLamVN\GameHandle\PlayerStat\PlayerStatManager;
use NgLamVN\GameHandle\Sell\SellHandler;
use NgLamVN\GameHandle\task\InitTask;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Core extends PluginBase{
	public const VERSION = "0.2.5-alpha";
	public const CODE_NAME = "BlueWhale";
	public const BASE_VERSION = 2; //FIv2
	/** @var int[] */
	public array $afktime = [];
	/** @var SellHandler $sell */
	public SellHandler $sell;
	/** @var PlayerStatManager $pstatmanager */
	protected PlayerStatManager $pstatmanager;
	protected static Core $instance;

	protected ?string $island_world_name = null;

	protected function onLoad() : void{
		self::$instance = $this;
	}

	public static function getInstance() : Core{
		return self::$instance;
	}

	public function onEnable() : void{
		try{
			if(!PacketHooker::isRegistered()){
				PacketHooker::register($this);
			}
		}catch(HookAlreadyRegistered){
			//Ignore Exception
		}
		try{
			if(!InvMenuHandler::isRegistered()){
				InvMenuHandler::register($this);
			}
			ListenerManager::register($this);
			new InitCommand($this);
			new InitTask($this);
			$this->pstatmanager = new PlayerStatManager();
			$this->sell = new SellHandler($this);
			//LOAD ALL WORLDS AND FIND ISLAND WORLD
			$worlds = [];
			foreach(scandir($this->getServer()->getDataPath() . "worlds") as $world){
				if($world === "." || $world === ".." || pathinfo($world, PATHINFO_EXTENSION) !== ""){
					continue;
				}
				$worlds[] = $world;
			}
			$worldmanager = $this->getServer()->getWorldManager();
			foreach($worlds as $world){
				if(!$worldmanager->isWorldLoaded($world)){
					$worldmanager->loadWorld($world);
					if(MyPlot::getInstance()->isLevelLoaded($world)){
						$this->island_world_name = $world;
					}else{
						$worldmanager->unloadWorld($worldmanager->getWorldByName($world));
					}
				}elseif(MyPlot::getInstance()->isLevelLoaded($world)){
					$this->island_world_name = $world;
				}
			}
			if($this->island_world_name == null){
				$this->getLogger()->warning("Island world not found, creating a new one...");
				$this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), "is generate island");
				$this->island_world_name = "island";
			}
		}catch(Exception $e){
			$this->getLogger()->logException($e);
			$this->getLogger()->error("An error caused by GameHandle, force disable this plugin...");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}
	}

	public function getPlayerGroupName(Player $player) : string{
		return $this->getHiearchy()->getMemberFactory()->getMember($player)->getTopRole()->getName();
	}

	public function getHiearchy() : ?Hierarchy{
		$plugin = $this->getServer()->getPluginManager()->getPlugin("Hierarchy");
		if($plugin instanceof Hierarchy){
			return $plugin;
		}
		return null;
	}

	public function getPlayerStatManager() : PlayerStatManager{
		return $this->pstatmanager;
	}

	public function getSellHandler() : SellHandler{
		return $this->sell;
	}

	public function getIslandWorldName() : ?string{
		return $this->island_world_name;
	}
}
