<?php
declare(strict_types=1);

namespace Bazaar\ui;

use Bazaar\Bazaar;
use pocketmine\player\Player;
use pocketmine\Server;

abstract class BaseUI{

	public function __construct(Player $player){
		$this->execute($player);
	}

	public function execute(Player $player) : void{
	}

	public function getBazaar() : ?Bazaar{
		$bazaar = Server::getInstance()->getPluginManager()->getPlugin("BazaarShop");
		if($bazaar instanceof Bazaar){
			return $bazaar;
		}
		return null;
	}
}
