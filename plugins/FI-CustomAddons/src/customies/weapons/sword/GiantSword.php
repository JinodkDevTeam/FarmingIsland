<?php
declare(strict_types=1);

namespace CustomAddons\customies\weapons\sword;

class GiantSword extends Sword{

	public function getTexture() : string{
		return "fici_giant_sword";
	}

	public function getBaseDamage() : int{
		return 500;
	}
}