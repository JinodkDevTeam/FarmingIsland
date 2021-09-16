<?php
declare(strict_types=1);

namespace FavoriteIslands\form;

use Generator;
use SOFe\AwaitGenerator\Await;

abstract class AwaitListForm extends BaseForm{

	protected function getList() : Generator{
		return $this->getLoader()->getProvider()->selectPlayer($this->getPlayer());
	}

	protected abstract function g2c() : Generator;

	protected function execute() : void{
		Await::g2c($this->g2c());
	}
}