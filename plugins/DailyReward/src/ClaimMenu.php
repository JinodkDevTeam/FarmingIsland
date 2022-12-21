<?php
declare(strict_types=1);

namespace NgLam2911\DailyReward;

use Closure;
use CustomAddons\customies\CustomiesItems;
use FILang\FILang;
use FILang\TranslationFactory;
use Generator;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use NgLam2911\DailyReward\provider\UserDataInfo;
use NgLam2911\DailyReward\reward\MoneyReward;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class ClaimMenu{

	//1  2  3  4  5  6
	//7  8  9  10 11 12
	//13 14 15 16 17 18
	//19 20 21 22 23 24
	//25 26 27 28 29 30
	protected InvMenu $menu;
	/** @var int[] */
	protected array $map = [];
	protected ?UserDataInfo $dataInfo;

	public function __construct(Player $player){
		Await::f2c(function() use ($player) : Generator{
			$this->dataInfo = yield from DailyReward::getInstance()->getProvider()->getUserData($player);
			if (is_null($this->dataInfo)){
				//Register
				yield DailyReward::getInstance()->getProvider()->asyncRegister($player);
				$this->dataInfo = yield from DailyReward::getInstance()->getProvider()->getUserData($player);
				if (is_null($this->dataInfo)){
					DailyReward::getInstance()->getLogger()->error("Can't get or register player data: " . $player->getName());
					return;
				}
			}
			$this->send($player);
		});
	}

	public function send(Player $player) : void{
		if ((time() - $this->dataInfo->getLastClaimtime()) > DailyReward::MISSTIME){
			$this->dataInfo->setStreak(0);
		}
		if ($this->dataInfo->getStreak() == 30){
			$this->dataInfo->setStreak(14); //Return back to 14
		}
		$this->menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
		$this->menu->setListener(Closure::fromCallable([$this, "menuListener"]));
		$this->menu->setInventoryCloseListener(Closure::fromCallable([$this, "menuCloseListener"]));
		$this->menu->setName(FILang::translate($player, TranslationFactory::dailyreward_menu_name()));
		$inv = $this->menu->getInventory();
		for($i = 0; $i < 54; $i++){
			$inv->setItem($i, CustomiesItems::NONE());
		}
		for($i = 0; $i < 5; $i++){
			for($j = 0; $j < 6; $j++){
				$number = 6 * $i + $j + 1;
				$index = 9 + $number + 3 * $i;
				$this->map[$index] = $number;
				if ($number <= $this->dataInfo->getStreak()){
					$inv->setItem($index, CustomiesItems::YES()->setCustomName(FILang::translate($player, TranslationFactory::dailyreward_menu_claimed())));
				} elseif ($number < 15){
					$inv->setItem($index, CustomiesItems::GREEN_GIFT()->setCustomName(FILang::translate($player, TranslationFactory::dailyreward_menu_prizename((string)$number))));
				} elseif ($number < 26){
					$inv->setItem($index, CustomiesItems::RED_GIFT()->setCustomName(FILang::translate($player, TranslationFactory::dailyreward_menu_prizename((string)$number))));
				} else {
					$inv->setItem($index, CustomiesItems::GOLDEN_GIFT()->setCustomName(FILang::translate($player, TranslationFactory::dailyreward_menu_prizename((string)$number))));
				}
			}
		}
		$this->menu->send($player);
	}

	public function menuListener(InvMenuTransaction $transaction) : InvMenuTransactionResult{
		$slot = $transaction->getAction()->getSlot();
		if (isset($this->map[$slot])){
			$player = $transaction->getPlayer();
			$day = $this->map[$slot];
			if (($this->dataInfo->getStreak() + 1) === $this->map[$slot]){
				if (($this->dataInfo->getLastClaimtime() + DailyReward::COOLDOWN) <= time()){
					if ($this->dataInfo->getStreak() > 0){
						if ((time() - $this->dataInfo->getLastClaimtime()) > DailyReward::MISSTIME){
							$this->dataInfo->setStreak(0);
							$player->sendMessage(FILang::translate($player, TranslationFactory::dailyreward_claim_fail_miss()));
							return $transaction->discard()->then(function(Player $player){
								$this->menu->onClose($player);
							});
						}
					}
					$this->claim($player, $day, $slot);
				} else {
					$player->sendMessage(FILang::translate($player, TranslationFactory::dailyreward_claim_fail_cooldown()));
					return $transaction->discard()->then(function(Player $player){
						$this->menu->onClose($player);
					});
				}
			} else {
				if (($this->dataInfo->getStreak() + 1) > $this->map[$slot]){
					return $transaction->discard();
				}
				$player->sendMessage(FILang::translate($player, TranslationFactory::dailyreward_claim_fail_invalid()));
				return $transaction->discard()->then(function(Player $player){
					$this->menu->onClose($player);
				});
			}
		}
		return $transaction->discard();
	}

	public function claim(Player $player, int $day, int $slot) : void{
		$reward = new MoneyReward($day * 100);
		$reward->getReward($player);
		$player->sendMessage(FILang::translate($player, TranslationFactory::dailyreward_claim_success((string)($day * 100))));
		$this->dataInfo->setStreak($day);
		$this->dataInfo->setLastClaimtime(time());
		$this->menu->getInventory()->setItem($slot, CustomiesItems::YES()->setCustomName("Claimed !"));
	}

	public function MenuCloseListener(Player $player, Inventory $inventory) : void{
		Await::f2c(function(){
			yield DailyReward::getInstance()->getProvider()->asyncUpdate($this->dataInfo);
		});
	}
}