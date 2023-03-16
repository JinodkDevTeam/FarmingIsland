<?php
declare(strict_types=1);

namespace NgLam2911\MineSweeper\area;

use Closure;
use CustomAddons\customies\CustomiesItems;
use NgLam2911\MineSweeper\area\texture\AreaTexture;
use NgLam2911\MineSweeper\area\texture\AreaTextures;
use NgLam2911\MineSweeper\MineSweeper;
use NgLam2911\MineSweeper\session\Session;
use NgLam2911\MineSweeper\session\SessionManager;
use NgLam2911\MineSweeper\task\StatusTask;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector2;
use pocketmine\player\Player;
use pocketmine\world\Position;

class Area{

	protected bool $isPlaying = false;

	public function __construct(
		protected string $name,
		protected Session $owner,
		protected ?Board $board = null,
		/** @var Session[] */
		protected array $players = [],
		protected ?Position $gamePos = null,
		protected ?AreaTexture $texture = null,
	){
	}

	public function getBoard() : ?Board{
		return $this->board;
	}

	public function setBoard(?Board $board) : void{
		$this->onPreBoardSet();
		$this->board = $board;
		$this->onBoardSet();
	}

	public function getGamePos() : ?Position{
		return $this->gamePos;
	}

	public function setGamePos(Position $pos) : void{
		$this->gamePos = $pos;
	}

	public function getAreaBB() : ?AxisAlignedBB{
		if ($this->gamePos === null){
			return null;
		}
		$pos = $this->gamePos;
		$minX = $pos->getFloorX();
		$minY = $pos->getFloorY();
		$minZ = $pos->getFloorZ();
		$maxY = $minY;
		if ($this->getBoard() === null){
			$maxX = $minX;
			$maxZ = $minZ;
		}else{
			$maxX = $minX + $this->getBoard()->getWidth() - 1;
			$maxZ = $minZ + $this->getBoard()->getHeight() - 1;
		}
		return new AxisAlignedBB($minX, $minY, $minZ, $maxX, $maxY, $maxZ);
	}

	public function isPlaying() : bool{
		return $this->isPlaying;
	}

	public function setPlaying(bool $playing) : void{
		$this->isPlaying = $playing;
	}

	public function getName() : string{
		return $this->name;
	}

	public function getOwner() : Session{
		return $this->owner;
	}

	public function setOwner(Session $owner) : void{
		$this->owner = $owner;
	}

	/**
	 * @return Session[]
	 */
	public function getPlayers() : array{
		return $this->players;
	}

	public function addPlayer(Session $player) : void{
		$this->players[$player->getName()] = $player;
		$player->addPlayingArea($this);
	}

	public function removePlayer(string|Session $name) : void{
		if ($name instanceof Session){
			$name = $name->getName();
		}
		$this->players[$name]->removePlayingArea($this);
		unset($this->players[$name]);
	}

	public function canPlay(string|Session|Player $player) : bool{
		if ($player instanceof Player){
			$player = $player->getName();
		}
		if ($player instanceof Session){
			$player = $player->getName();
		}
		return isset($this->players[$player]);
	}

	public function getTexture() : ?AreaTexture{
		return $this->texture;
	}

	public function setTexture(AreaTexture $texture) : void{
		$old = $this->texture;
		$this->texture = $texture;
		if ($old !== $texture){
			$this->onTextureChange();
		}
	}

	protected function clean() : void{
		if (isset($this->board)){
			// Clear all block
			for($i = 0; $i < $this->board->getWidth(); $i++){
				for($j = 0; $j < $this->board->getHeight(); $j++){
					$this->gamePos->getWorld()->setBlock($this->gamePos->add($i, 0, $j), VanillaBlocks::AIR());
				}
			}
			$this->board == null;
		}
		$this->onBoardClean();
	}

	public function updateBoard(?int $optionalMode = null) : void{
		$texture = $this->getTexture();
		if ($texture === null){
			$texture = AreaTextures::VANILLA();
		}
		$mode = ($optionalMode === null)?AreaTexture::MODE_PLAYING:$optionalMode;
		$board = $this->getBoard();
		if ($board === null){
			return;
		}
		if ($optionalMode === null){
			if ($board->isGameOver()){
				$mode = AreaTexture::MODE_LOSE;
			}
			if ($board->isWinned()){
				$mode = AreaTexture::MODE_WIN;
			}
		}
		$pos = $this->getGamePos();
		if ($pos === null){
			return;
		}
		for($i = 0; $i < $board->getWidth(); $i++){
			for($j = 0; $j < $board->getHeight(); $j++){
				$tile = $board->getTile(new Vector2($i, $j));
				if ($tile === null){
					continue;
				}
				$block = $texture->parseTile($tile, $mode);
				$pos->getWorld()->setBlock($pos->add($i, 0, $j), $block);
			}
		}
	}

	public function onInteract(Player $player, Position $pos, Item $item) : void{
		if(is_null($this->getGamePos()) || is_null($this->getBoard())){
			return;
		}
		$pos = $pos->subtractVector($this->getGamePos()->floor());
		if(!$this->canPlay($player)){
			$player->sendMessage("You are not able to play in this area");
			return;
		}
		$session = SessionManager::getInstance()->getSession($player->getName());
		if($session === null){
			$player->sendMessage("You are not able to play in this area");
			return;
		}
		if ($this->getBoard()->isWinned() || $this->getBoard()->isGameOver()){
			return;
		}
		switch($item->getId()){
			case VanillaItems::IRON_SHOVEL()->getId():
				$this->getBoard()->interact(new Vector2($pos->getFloorX(), $pos->getFloorZ()),
					false, $session->isAutoFlag(), $session->isAutoExplode(), $session->isRecursiveExplode());
				break;
			case CustomiesItems::ITEM_FLAG()->getId():
				$this->getBoard()->interact(new Vector2($pos->getFloorX(), $pos->getFloorZ()),
					true, $session->isAutoFlag(), $session->isAutoExplode(), $session->isRecursiveExplode());
				break;
		}
		if($this->getBoard()->getStartPos() !== null){
			$this->onGameStart();
		}
		if($this->getBoard()->isGameOver()){
			$this->onGameover();
		}
		if($this->getBoard()->isWinned()){
			$this->onWin();
		}
		$this->updateBoard();
	}

	protected function onGameover() : void{
		$this->areaBroadcast(fn(Player $player) => $player->sendMessage("Gameover"));
		$this->setPlaying(false);
	}

	protected function onWin() : void{
		$this->areaBroadcast(fn(Player $player) => $player->sendMessage("You win"));
		$this->setPlaying(false);
	}

	protected function onGameStart() : void{
		$this->isPlaying = true;
		MineSweeper::getInstance()->getScheduler()->scheduleRepeatingTask(new StatusTask($this), 20);
	}

	protected function onBoardSet() : void{
		if ($this->board !== null){
			$this->updateBoard();
			$this->giveItems();
		}
	}

	protected function onPreBoardSet() : void{
		if ($this->getBoard() !== null){
			$this->clean();
		}
	}

	protected function onBoardClean() : void{
		$this->clearItems();
		$this->setPlaying(false);
	}

	protected function onTextureChange() : void{
		$this->updateBoard();
		//Update items
	}

	protected function giveItems() : void{
		$this->areaBroadcast(function(Player $player){
			$player->getInventory()->setItem(0, CustomiesItems::ITEM_FLAG());
			$player->getInventory()->setItem(1, VanillaItems::IRON_SHOVEL());
		});
	}

	protected function clearItems() : void{
		$this->areaBroadcast(function(Player $player){
			$player->getInventory()->setItem(0, VanillaItems::AIR());
			$player->getInventory()->setItem(1, VanillaItems::AIR());
		});
	}

	protected function areaBroadcast(Closure $closure) : void{
		foreach($this->getPlayers() as $player){
			$closure($player->getPlayer());
		}
	}
}