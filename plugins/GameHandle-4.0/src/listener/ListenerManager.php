<?php
declare(strict_types=1);

namespace NgLamVN\GameHandle\listener;

use NgLamVN\GameHandle\Core;

class ListenerManager{

	public static function register(Core $core) : void{
		$plmanager = $core->getServer()->getPluginManager();
		$plmanager->registerEvents(new MainListener($core), $core);
		$plmanager->registerEvents(new ChatThinListener(), $core);
		$plmanager->registerEvents(new GrowableSneakListener(), $core);
	}
}