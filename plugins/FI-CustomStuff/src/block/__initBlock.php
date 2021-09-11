<?php
declare(strict_types=1);

namespace CustomStuff\block;

use CustomStuff\CustomStuff;

class __initBlock{
	public CustomStuff $core;

	public function __construct(CustomStuff $core){
		$this->core = $core;
		$plmng = $this->core->getServer()->getPluginManager();

		$plmng->registerEvents(new InferiumSeed(), $this->core);
	}
}