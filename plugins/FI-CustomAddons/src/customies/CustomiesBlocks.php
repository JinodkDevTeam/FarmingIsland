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
 *
 * @method static Opaque ONE()
 * @method static Opaque TWO()
 * @method static Opaque THREE()
 * @method static Opaque FOUR()
 * @method static Opaque FIVE()
 * @method static Opaque SIX()
 * @method static Opaque SEVEN()
 * @method static Opaque EIGHT()
 * @method static Opaque MINE()
 * @method static Opaque MINE_RED()
 * @method static Opaque MINE_RED_CROSS()
 * @method static Opaque FLAG()
 * @method static Opaque QUESTION()
 * @method static Opaque EMPTY()
 * @method static Opaque UNOPENED()
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

		//For minesweeper
		self::register("one", $factory->get("ms:one"));
		self::register("two", $factory->get("ms:two"));
		self::register("three", $factory->get("ms:three"));
		self::register("four", $factory->get("ms:four"));
		self::register("five", $factory->get("ms:five"));
		self::register("six", $factory->get("ms:six"));
		self::register("seven", $factory->get("ms:seven"));
		self::register("eight", $factory->get("ms:eight"));
		self::register("mine", $factory->get("ms:mine"));
		self::register("mine_red", $factory->get("ms:mine_red"));
		self::register("mine_red_cross", $factory->get("ms:mine_red_cross"));
		self::register("flag", $factory->get("ms:flag"));
		self::register("question", $factory->get("ms:question"));
		self::register("empty", $factory->get("ms:empty"));
		self::register("unopened", $factory->get("ms:unopened"));

	}
}