<?php

declare(strict_types=1);

namespace NgLamVN\GameHandle\PlayerStat;

use NgLamVN\GameHandle\Core;
use NgLamVN\GameHandle\Sell\SellUndoAction;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\Position;

/**
 * Class PlayerStat
 * @package NgLamVN\GameHandle
 */
class PlayerStat{
	/** @var Player */
	protected Player $player;
	/** @var bool */
	protected bool $isFly = false;
	/** @var bool */
	protected bool $isMuted = false;
	/** @var int */
	protected int $mute_time = 0;
	/** @var int */
	protected int $mute_start_time = 0;
	/** @var bool */
	protected bool $isFreeze = false;
	/** @var int */
	protected int $freeze_time = 0;
	/** @var int */
	protected int $freeze_start_time = 0;
	/** @var bool */
	protected bool $is_notp = false;
	/** @var Position|null */
	protected ?Position $death_pos = null;
	/** @var SellUndoAction|null */
	protected ?SellUndoAction $sellUndoAction = null;

	/**
	 * PlayerStat constructor.
	 *
	 * @param Player $player
	 */

	public function __construct(Player $player){
		$this->player = $player;
	}

	public function toArray() : array{
		return [
			$this->getPlayer(),
			$this->isFly(),
			$this->isMuted(),
			$this->getMuteTime(),
			$this->getMuteStartTime(),
			$this->isFreeze(),
			$this->getFreezeTime(),
			$this->getFreezeStartTime(),
			$this->getDeathPos()
		];
	}

	/**
	 * @return Player
	 */
	public function getPlayer() : Player{
		return $this->player;
	}

	/**
	 * @return bool
	 */
	public function isFly() : bool{
		return $this->isFly;
	}

	/**
	 * @return bool
	 */
	public function isMuted() : bool{
		if($this->isMuted){
			if(time() > $this->getExpireTime($this->getMuteTime(), $this->getMuteStartTime())){
				$this->setMute(false);
			}
		}
		return $this->isMuted;
	}

	/**
	 * @param $time
	 * @param $starttime
	 *
	 * @return int
	 */
	protected function getExpireTime($time, $starttime) : int{
		if(($time + $starttime) > PHP_INT_MAX) return PHP_INT_MAX;
		return $time + $starttime;
	}

	/**
	 * @return int
	 */
	public function getMuteTime() : int{
		return $this->mute_time;
	}

	/**
	 * @param int $time
	 */
	public function setMuteTime(int $time = 0){
		$this->mute_time = $time;
	}

	/**
	 * @return int
	 */
	public function getMuteStartTime() : int{
		return $this->mute_start_time;
	}

	/**
	 * @param int $time
	 */
	public function setMuteStartTime(int $time = 0){
		$this->mute_start_time = $time;
	}

	/**
	 * @param bool $status
	 * @param int  $time
	 */
	public function setMute(bool $status = true, int $time = PHP_INT_MAX){
		$this->isMuted = $status;
		if($status){
			$this->setMuteTime($time);
			$this->setMuteStartTime(time());
		}else{
			$this->setMuteTime();
			$this->setMuteStartTime();
		}
	}

	/**
	 * @return bool
	 */
	public function isFreeze() : bool{
		if(time() > $this->getExpireTime($this->getFreezeTime(), $this->getFreezeStartTime())){
			$this->setFreeze(false);
		}
		return $this->isFreeze;
	}

	/**
	 * @return int
	 */
	public function getFreezeTime() : int{
		return $this->freeze_time;
	}

	/**
	 * @param int $time
	 */
	public function setFreezeTime(int $time = 0){
		$this->freeze_time = $time;
	}

	/**
	 * @return int
	 */
	public function getFreezeStartTime() : int{
		return $this->freeze_start_time;
	}

	/**
	 * @param int $time
	 */
	public function setFreezeStartTime(int $time = 0){
		$this->freeze_start_time = $time;
	}

	/**
	 * @param bool $status
	 * @param int  $time
	 */
	public function setFreeze(bool $status = true, int $time = PHP_INT_MAX){
		$this->isFreeze = $status;
		if($status){
			$this->setFreezeTime($time);
			$this->setFreezeStartTime(time());
		}else{
			$this->setFreezeTime();
			$this->setFreezeStartTime();
		}
	}

	/**
	 * @return Position|null
	 */
	public function getDeathPos() : ?Position{
		return $this->death_pos;
	}

	/**
	 * @param Position|null $pos
	 */
	public function setDeathPos(?Position $pos) : void{
		$this->death_pos = $pos;
	}

	public function getCore() : ?Core{
		$core = Server::getInstance()->getPluginManager()->getPlugin("FI-GameHandle");
		if($core instanceof Core){
			return $core;
		}
		return null;
	}

	/**
	 * @return bool
	 */
	public function isNoTP() : bool{
		return $this->is_notp;
	}

	public function getSellUndoAction() : ?SellUndoAction{
		return $this->sellUndoAction;
	}

	public function setSellUndoAction(?SellUndoAction $action) : void{
		$this->sellUndoAction = $action;
	}

	/**
	 * @param bool $status
	 */
	public function setFly(bool $status = true){
		$this->isFly = $status;
	}

	public function setNoTP(bool $status = true){
		$this->is_notp = $status;
	}
}
