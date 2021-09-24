<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle;

use CortexPE\Hierarchy\Hierarchy;
use Exception;
use muqsit\invmenu\InvMenuHandler;
use NgLamVN\GameHandle\ChatThin\CT_PacketHandler;
use NgLamVN\GameHandle\command\InitCommand;
use NgLamVN\GameHandle\InvCrashFix\IC_PacketHandler;
use NgLamVN\GameHandle\PlayerStat\PlayerStatManager;
use NgLamVN\GameHandle\Sell\SellHandler;
use NgLamVN\GameHandle\task\InitTask;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Core extends PluginBase{
	public const VERSION = "0.1-indev";
	public const BUILD_NUMBER = "4";
	public const INDEV = true;

	use SingletonTrait;

	/** @var int[] */
	public array $afktime = [];
	/** @var SellHandler $sell */
	public SellHandler $sell;
	/** @var PlayerStatManager $pstatmanager */
	private PlayerStatManager $pstatmanager;

	public function onEnable() : void{
		try{
			if(!InvMenuHandler::isRegistered()){
				InvMenuHandler::register($this);
			}

			$plmanager = $this->getServer()->getPluginManager();
			$plmanager->registerEvents(new EventListener($this), $this);
			$plmanager->registerEvents(new IC_PacketHandler(), $this);
			$plmanager->registerEvents(new CT_PacketHandler(), $this);
			new InitCommand($this);
			new InitTask($this);
			$this->pstatmanager = new PlayerStatManager();
			$this->sell = new SellHandler($this);
		}catch(Exception $e){
			$this->getLogger()->error($e->getMessage());
			$this->getLogger()->error("An error caused by GameHandle, force disable this plugin...");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}
	}

	public function onDisable() : void{
	}

	/*public function CreateIsland (Player $player)
	{
		Server::getInstance()->dispatchCommand($player, "is auto");
		Server::getInstance()->dispatchCommand($player, "is claim");
		$player->sendMessage("Lest Play !");
	}*/

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
}
