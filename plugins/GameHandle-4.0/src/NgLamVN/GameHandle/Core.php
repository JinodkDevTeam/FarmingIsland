<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle;

use _64FF00\PurePerms\PurePerms;
use muqsit\invmenu\InvMenuHandler;
use NgLamVN\GameHandle\ChatThin\CT_PacketHandler;
use NgLamVN\GameHandle\CoinSystem\CoinSystem;
use NgLamVN\GameHandle\command\InitCommand;
use NgLamVN\GameHandle\InvCrashFix\IC_PacketHandler;
use NgLamVN\GameHandle\Sell\SellHandler;
use NgLamVN\GameHandle\task\InitTask;
use pocketmine\entity\Skin;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class Core extends PluginBase
{
	use SingletonTrait;
    /** @var int[] */
    public array $afktime = [];

    public CoinSystem $coin;

    public PlayerStatManager $pstatmanager;
    /** @var Skin[] */
    public array $skin = [];

    public SellHandler $sell;

    public function onEnable(): void
    {

        if(!InvMenuHandler::isRegistered())
        {
            InvMenuHandler::register($this);
        }

        $plmanager = $this->getServer()->getPluginManager();
        $plmanager->registerEvents(new EventListener($this), $this);
        $plmanager->registerEvents(new IC_PacketHandler(), $this);
        $plmanager->registerEvents(new CT_PacketHandler(), $this);
        new InitCommand($this);
        new InitTask($this);
        $this->coin = new CoinSystem($this);
        $this->pstatmanager = new PlayerStatManager();
        $this->sell = new SellHandler($this);

    }
    public function onDisable(): void
    {
    }

    public function CreateIsland (Player $player)
    {
        Server::getInstance()->dispatchCommand($player, "is auto");
        Server::getInstance()->dispatchCommand($player, "is claim");
        $player->sendMessage("Lest Play !");
    }

    public function getPP(): ?PurePerms
    {
    	$plugin = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
    	if ($plugin instanceof PurePerms)
		{
			return $plugin;
		}
        return null;
    }

    public function getPlayerGroupName(Player $player)
    {
        $group = $this->getPP()->getUserDataMgr()->getGroup($player)->getName();
        return $group;
    }

    public function getCoinSystem(): CoinSystem
    {
        return $this->coin;
    }

    public function getPlayerStatManager(): PlayerStatManager
    {
        return $this->pstatmanager;
    }

    public function getSellHandler(): SellHandler
	{
		return $this->sell;
	}
}
