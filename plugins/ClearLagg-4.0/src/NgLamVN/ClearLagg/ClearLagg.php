<?php
declare(strict_types=1);

namespace NgLamVN\ClearLagg;

use FILang\FILang;
use FILang\TranslationFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Entity;
use pocketmine\entity\Human;
use pocketmine\entity\Living;
use pocketmine\entity\object\ExperienceOrb;
use pocketmine\entity\object\ItemEntity;
use pocketmine\entity\object\PrimedTNT;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use function array_map;
use function in_array;
use function is_array;
use function is_numeric;
use function strtolower;

class ClearLagg extends PluginBase{

	/** @var int */
	private int $interval;
	/** @var int */
	private int $seconds;

	/** @var bool */
	private bool $clearItems;
	/** @var bool */
	private bool $clearMobs;
	/** @var bool */
	private bool $clearXpOrbs;

	/** @var string[] */
	private array $exemptEntities;

	/** @var int[] */
	private array $broadcastTimes;

	public function onEnable() : void{
		$config = $this->getConfig()->getAll();

		if(!is_numeric($config["seconds"] ?? 300)){
			$this->getLogger()->error("Config error: seconds attribute must an integer");
			$this->getServer()->getPluginManager()->disablePlugin($this);

			return;
		}
		$this->interval = $this->seconds = $config["seconds"];

		if(!is_array($config["clear"] ?? [])){
			$this->getLogger()->error("Config error: clear attribute must an array");
			$this->getServer()->getPluginManager()->disablePlugin($this);

			return;
		}
		$clear = $config["clear"] ?? [];
		$this->clearItems = (bool) ($clear["items"] ?? false);
		$this->clearMobs = (bool) ($clear["mobs"] ?? false);
		$this->clearXpOrbs = (bool) ($clear["xp-orbs"] ?? false);
		if(!is_array($clear["exempt"] ?? [])){
			$this->getLogger()->error("Config error: clear.exempt attribute must an array");
			$this->getServer()->getPluginManager()->disablePlugin($this);

			return;
		}
		$this->exemptEntities = array_map(function($entity) : string{
			return strtolower((string) $entity);
		}, $clear["exempt"] ?? []);

		if(!is_array($config["messages"] ?? [])){
			$this->getLogger()->error("Config error: times attribute must an array");
			$this->getServer()->getPluginManager()->disablePlugin($this);

			return;
		}

		if(!is_array($config["times"] ?? [])){
			$this->getLogger()->error("Config error: times attribute must an array");
			$this->getServer()->getPluginManager()->disablePlugin($this);

			return;
		}
		$this->broadcastTimes = $config["times"] ?? [60, 30, 15, 10, 5, 4, 3, 2, 1];

		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() : void{
			if(--$this->seconds === 0){
				$this->clearLagg();
				$this->seconds = $this->interval;
			}elseif(in_array($this->seconds, $this->broadcastTimes)){
				foreach($this->getServer()->getOnlinePlayers() as $player){
					$player->sendMessage(FILang::translate($player, TranslationFactory::clearlagg_timeleft((string)$this->seconds)));
				}
			}
		}), 20);
	}

	public function clearLagg($safeClearlagg = true) : void{
		$entitiesCleared = 0;
		foreach($this->getServer()->getWorldManager()->getWorlds() as $world){
			foreach($world->getEntities() as $entity){
				if ($safeClearlagg){
					if($this->clearItems && $entity instanceof ItemEntity){
						$entity->flagForDespawn();
						++$entitiesCleared;
					}elseif($this->clearMobs && $entity instanceof Living && !$entity instanceof Human){
						if(!$this->isExemptedEntity($entity)){
							$entity->flagForDespawn();
							++$entitiesCleared;
						}
					}elseif($this->clearXpOrbs && $entity instanceof ExperienceOrb){
						$entity->flagForDespawn();
						++$entitiesCleared;
					}elseif($entity instanceof PrimedTNT){
						$entity->flagForDespawn();
						++$entitiesCleared;
					}
				} else {
					if (!$entity instanceof Player){
						$entity->flagForDespawn();
						++$entitiesCleared;
					}
				}
			}
		}
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$player->sendMessage(FILang::translate($player, TranslationFactory::clearlagg_cleared((string)$entitiesCleared)));
		}
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if(strtolower($command->getName()) !== "clearlagg"){
			return true;
		}
		if(!$sender->hasPermission("clearlagg.cmd")){
			$sender->sendMessage(FILang::translate($sender, TranslationFactory::command_noperm()));
			return true;
		}
		if (!isset($args[0])){
			$this->clearLagg();
		} else {
			if ($args[0] == "all"){
				$this->clearLagg(false);
			}
		}
		return true;
	}

	public function exemptEntity(Entity $entity){
		$this->exemptEntities[] = strtolower($entity->getNameTag());
	}

	public function isExemptedEntity(Entity $entity) : bool{
		if ($entity instanceof Living){
			if (in_array($entity->getNameTag(), $this->exemptEntities)){
				return true;
			}
			return in_array(strtolower($entity->getName()), $this->exemptEntities);
		}
		return in_array($entity->getNameTag(), $this->exemptEntities);
	}
}
