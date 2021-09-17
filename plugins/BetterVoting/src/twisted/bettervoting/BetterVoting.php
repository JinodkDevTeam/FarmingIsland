<?php
declare(strict_types=1);

namespace twisted\bettervoting;

/*use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\PiggyCustomEnchants;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\VanillaItems;*/

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use twisted\bettervoting\command\VoteCommand;
use twisted\bettervoting\thread\BetterVotingThread;

/*use pocketmine\utils\TextFormat;*/

/*use function array_slice;
use function count;
use function explode;
use function strtoupper;
use function constant;
use function defined;*/

final class BetterVoting extends PluginBase{

	/** @var Plugin|null */
	/*private ?Plugin $piggyCustomEnchants = null;*/

	/** @var BetterVotingThread */
	private BetterVotingThread $thread;

	public function onEnable() : void{
		/*$this->piggyCustomEnchants = $this->getServer()->getPluginManager()->getPlugin("PiggyCustomEnchants");*/

		$this->thread = $thread = new BetterVotingThread();

		$this->loadConfig();

		$this->getServer()->getCommandMap()->register("bettervoting", new VoteCommand($this));
		$this->getServer()->getPluginManager()->registerEvents(new BetterVotingListener($this), $this);

		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(static function() use ($thread) : void{
			$thread->addActionToQueue(BetterVotingThread::ACTION_UPDATE_CACHE);

		}), BetterVotingCache::TIME_BETWEEN_CACHE_UPDATE * 20);
		$server = $this->getServer();
		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(static function() use ($thread, $server) : void{
			$thread->collectActionResults($server);
		}), 1);
	}

	/**
	 * Reload the plugin's config and all of it's data.
	 */
	public function loadConfig() : void{
		$this->reloadConfig();
		$config = $this->getConfig();

		$this->thread->setApiKey((string) $config->get("api-key", ""));

		$commands = [];
		/*foreach($config->get("commands", []) as $command){
			$commands[] = TextFormat::colorize($command);
		}*/
		BetterVotingCache::setCommands($commands);

		$items = [];
		/*foreach($config->get("items") as $itemInfo){
			$parts = explode(":", $itemInfo);

			$item = VanillaItems::fromString($parts[0] . ":" . ($parts[1] ?? 0));

			$item->setCount((int) ($parts[2] ?? 1) > 0 ? (int) ($parts[2] ?? 1) : 1);
			if(($parts[3] ?? "default") !== "default"){
				$item->setCustomName(TextFormat::colorize($parts[3]));
			}

			if(count($parts) > 4){
				$enchants = array_slice($parts, 4);
				for($i = 0; $i < count($enchants); $i += 2){
					$enchant = null;
					/*if($this->piggyCustomEnchants !== null){
						$const = CustomEnchantIds::class . "::" . strtoupper($enchants[$i] ?? "");
						if(defined($const)){
							$enchant = CustomEnchant::getEnchantment(constant($const));
						}
					}*/
		/*if($enchant === null){
			$enchant = VanillaEnchantments::fromString($enchants[$i] ?? "");
		}

		if($enchant !== null){
			$level = (int) ($enchants[$i + 1] ?? 1);
			$level = $level > 0 ? $level : 1;

			$item->addEnchantment(new EnchantmentInstance($enchant, $level));
		}
	}
}
$items[] = $item;
}*/
		BetterVotingCache::setItems($items);
	}

	/**
	 * Returns the thread used for voting related actions.
	 *
	 * @return BetterVotingThread
	 */
	public function getVoteThread() : BetterVotingThread{
		return $this->thread;
	}
}