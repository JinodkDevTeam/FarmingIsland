<?php
declare(strict_types=1);

namespace Backpack\ui;

use Backpack\Loader;
use FILang\FILang;
use FILang\TranslationFactory;
use JinodkDevTeam\utils\ItemUtils;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BackpackOpenGUI extends BaseUI{

	protected int $slot;

	public function __construct(Loader $loader, Player $player, int $slot){
		$this->slot = $slot;
		parent::__construct($loader, $player);
	}

	protected function execute(Player $player) : void{
		Await::f2c(function() use ($player){
			$data = yield from $this->getLoader()->getProvider()->selectSlot($player, $this->slot);
			if (empty($data)){
				$player->sendMessage(FILang::translate($player, TranslationFactory::backback_openfail2()));
				return;
			}
			$data = $data[0];
			$menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
			$menu->setName(FILang::translate($player, TranslationFactory::backpack_gui_name((string)$this->slot)));
			$menu->getInventory()->setContents(ItemUtils::binString2itemArray(hex2bin($data["Data"])));
			$menu->setInventoryCloseListener(function(Player $player, Inventory $inventory){
				$data = bin2hex(ItemUtils::itemArray2binString($inventory->getContents(true)));
				$this->getLoader()->getProvider()->update($player, $this->slot, $data);
			});
			$menu->send($player);
		});
	}
}