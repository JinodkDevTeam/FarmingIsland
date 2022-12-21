<?php
declare(strict_types=1);

namespace CustomAddons\customies;

use customiesdevs\customies\block\CustomiesBlockFactory;
use pocketmine\block\Block;
use pocketmine\block\Opaque;
use pocketmine\utils\RegistryTrait;

/**
 * @generate-registry-docblock
 *
 * @method static Opaque MITHRIL_ORE()
 * @method static Opaque TITANIUM_ORE()
 */
class CustomiesBlocks{
	use RegistryTrait;
	protected static function register(string $name, Block $item) : void{
		self::_registryRegister($name, $item);
	}

	/**
	 * @return Block[]
	 */
	public static function getAll() : array{
		/** @var Block[] $result */
		$result = self::_registryGetAll();
		return $result;
	}

	protected static function setup() : void{
		$factory = CustomiesBlockFactory::getInstance();
		self::register("mithril_ore", $factory->get("ficb:mithril_ore"));
		self::register("titanium_ore", $factory->get("ficb:titanium_ore"));
	}
}