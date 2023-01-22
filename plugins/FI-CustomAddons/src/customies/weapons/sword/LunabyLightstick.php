<?php
declare(strict_types=1);

namespace CustomAddons\customies\weapons\sword;

class LunabyLightstick extends Sword{
	public function getTexture() : string{
		return "fici_lunaby_lightstick";
	}

	public function getBaseDamage() : int{
		return 999;
	}
}