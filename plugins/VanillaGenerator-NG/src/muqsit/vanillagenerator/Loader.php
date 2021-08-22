<?php

declare(strict_types=1);

namespace muqsit\vanillagenerator;

use muqsit\vanillagenerator\generator\NetherGenerator;
use muqsit\vanillagenerator\generator\OverworldGenerator;
use pocketmine\plugin\PluginBase;
use pocketmine\world\generator\GeneratorManager;

final class Loader extends PluginBase
{

	private const EXT_MCGENERATOR_VERSION = "2.0.0";

	public function onLoad(): void
	{
		if (!extension_loaded('vanillagenerator')) {
			$this->getLogger()->critical("Unable to find the vanillagenerator extension.");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		} elseif (($phpver = phpversion('vanillagenerator')) < self::EXT_MCGENERATOR_VERSION) {
			$this->getLogger()->critical("vanillagenerator extension version " . self::EXT_MCGENERATOR_VERSION . " is required, you have $phpver.");
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		}

		$generatorManager = GeneratorManager::getInstance();
		$generatorManager->addGenerator(NetherGenerator::class, "vanilla_nether");
		$generatorManager->addGenerator(OverworldGenerator::class, "vanilla_overworld");
	}
}
