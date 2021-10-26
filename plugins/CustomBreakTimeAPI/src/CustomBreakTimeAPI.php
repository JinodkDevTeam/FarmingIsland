<?php
declare(strict_types=1);

namespace NgLamVN\CustomBreakTimeAPI;

use Closure;
use muqsit\simplepackethandler\monitor\IPacketMonitor;
use muqsit\simplepackethandler\SimplePacketHandler;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\network\mcpe\protocol\types\PlayerAction;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use RuntimeException;

class CustomBreakTimeAPI extends PluginBase{
	/** @var BaseBreakTime[] $data */
	public static array $data = [];
	/** @var bool[] */
	protected array $breaking = [];
	/** @var BreakTask[] */
	protected array $task = [];

	protected IPacketMonitor $packet_monitor;

	public function isBreaking(Player $player) : bool{
		if(!isset($this->breaking[$player->getName()])) return false;
		else return $this->breaking[$player->getName()];
	}

	public function setBreakStatus(Player $player, bool $status){
		$this->breaking[$player->getName()] = $status;
	}

	/**
	 * @throws RuntimeException
	 */
	public static function register(BaseBreakTime $baseBreakTime){
		$name = $baseBreakTime->getName();
		if(isset(self::$data[$name])) throw new RuntimeException("A BaseBreakTime config with that name aldready registered !");
		self::$data[$name] = $baseBreakTime;
	}

	public static function getBaseBreakTime(Item $item) : ?BaseBreakTime{
		$nbt = $item->getNamedTag();
		if($nbt->getTag("basebreaktime") == null) return null;
		$config = $nbt->getString("basebreaktime");

		return self::$data[$config] ?? null;
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventHandler($this), $this);
		$this->packet_monitor = SimplePacketHandler::createMonitor($this);
		$this->packet_monitor->monitorIncoming(Closure::fromCallable([$this, "handleMonitorPacket"]));
	}

	public function handleMonitorPacket(PlayerActionPacket $packet, NetworkSession $session) : void{
		$player = $session->getPlayer();
		if($player->getGamemode() !== GameMode::SURVIVAL()){
			return;
		}
		switch($packet->action){
			case PlayerAction::START_SNEAK:
				$item = $player->getInventory()->getItemInHand();
				$basetime = CustomBreakTimeAPI::getBaseBreakTime($item);
				if($basetime == null) return;
				$pos = new Vector3($packet->x, $packet->y, $packet->z);
				$block = $player->getWorld()->getBlock($pos);
				$time = $basetime->reCaculateBreakTime($block, $item, $player);
				$this->setBreakStatus($player, true);
				$this->task[$player->getName()] = new BreakTask($player, $pos, $this);
				$this->getScheduler()->scheduleDelayedTask($this->task[$player->getName()], $time);
				break;
			case PlayerAction::ABORT_BREAK:
			case PlayerAction::STOP_BREAK:
				$this->setBreakStatus($player, false);
				if(isset($this->task[$player->getName()])){
					$this->task[$player->getName()]->cancel();
				}
				break;
		}
	}
}