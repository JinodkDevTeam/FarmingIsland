<?php
declare(strict_types=1);

namespace SkillLevel;

use Exception;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use SkillLevel\provider\Sqlite3Provider;
use SOFe\AwaitGenerator\Await;
use Throwable;

class SkillLevel extends PluginBase{
	public const MINING = 1;
	public const FISHING = 2;
	public const FARMING = 3;
	public const FORAGING = 4;

	private PlayerSkillLevelManager $manager;
	private Sqlite3Provider $provider;

	public function onEnable() : void{
		$this->saveDefaultConfig();
		$this->provider = new Sqlite3Provider($this);
		try{
			$this->getProvider()->register();
		}catch(Exception){
			$this->getLogger()->info("Failed to load database, disable this plugin ...");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->manager = new PlayerSkillLevelManager();
	}

	public function getProvider() : Sqlite3Provider{
		return $this->provider;
	}

	public function onDisable() : void{
		$this->getProvider()->save();
	}

	public function loadPlayer(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield $this->getProvider()->asyncSelect(Sqlite3Provider::LOAD_PLAYER, ["player" => $player->getName()]);
			if(empty($data)){
				$this->getProvider()->addPlayerData($player);
			}
			$data = yield $this->getProvider()->asyncSelect(Sqlite3Provider::LOAD_PLAYER, ["player" => $player->getName()]);
			$this->getPlayerSkillLevelManager()->registerPlayer($player, $data[0]);
		}, function(){ }, function(Throwable $err){
			$this->getLogger()->logException($err);
		});
	}

	public function getPlayerSkillLevelManager() : PlayerSkillLevelManager{
		return $this->manager;
	}

	public function unloadPlayer(Player $player) : void{
		$data = $this->getPlayerSkillLevelManager()->getPlayerSkillLevel($player);
		if ($data === null){
			$this->getLogger()->error("Unable to save data of player " . $player->getName());
			return;
		}
		for($i = 1; $i <= 4; $i++){
			$this->getProvider()->updateExp($player, $i, $data->getSkillExp($i));
			$this->getProvider()->updateLevel($player, $i, $data->getSkillLevel($i));
		}
		$this->getPlayerSkillLevelManager()->unregisterPlayer($player);
	}
}
